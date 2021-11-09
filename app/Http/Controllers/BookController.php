<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BorrowingBook;
use App\Models\Type;
use App\Models\Country;
use App\Http\Requests\BookRequest;
use App\Http\Requests\BookUpdateRequest;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Book as BookResource;
use Illuminate\Support\Facades\File;
use mysqli;
use SplQueue;
use GuzzleHttp\Client;

use function GuzzleHttp\Promise\queue;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'check-role'], ['only' => ['store', 'update', 'destroy']]);
        // $this->middleware('check-role', ['only' => ['index']]);

    }

    public function index(Request $request)
    {


        $books = Book::filter($request->all())->get();
        $types = Type::all();
        foreach ($books as $book) {
            // $type = $this->getTypeOfBook($book, $types);
            // $book->type = $type;
            $book->borrowing = BorrowingBook::where([['book_id', $book->book_id], ['status_id', 1]])->count() != 0;
        }

        return response()->json([
            'books' => $books,
        ]);
    }

    public function store(BookRequest $request)
    {
        $urlBookImage = 'https://i.ibb.co/rdhND5D/image-book.png';
        if ($request->hasFile('book_image')) {
            $file = $request->book_image;
            $urlFile = $file->getRealPath();
            $nameFile = $file->getClientOriginalName();
            $arrImage = $this->uploadImage($urlFile, $nameFile);

            if ($arrImage['status'] == 'ok') {
                $urlBookImage = $arrImage['url'];
            }
        } else {
            // echo 'loi';
        }

        $book = Book::create(array_merge(
            $request->except('book_image'),
            ['book_image' => $urlBookImage]
        ));

        $types = Type::all();

        // $type = $this->getTypeOfBook($book, $types);
        // $book->type = $type;
        return response()->json([
            'book' => $book,
        ], 200);
    }


    public function show($id)
    {
        if (Book::where('book_id', $id)->count() == 0) {
            return response()->json([
                'status' => 'error',
                'messenger' => 'Sách không tồn tại'
            ], 422);
        }

        $book = Book::where('book_id', $id)->first();
        $types = Type::all();
        // $type = $this->getTypeOfBook($book, $types);
        // $book->type = $type;

        return $book;
    }

    public function update(BookUpdateRequest $request, $id)
    {

        if (Book::where('book_id', $id)->count() == 0) {
            return response()->json([
                'status' => 'error',
                'messenger' => 'Sách không tồn tại'
            ], 422);
        }

        $book = false;
        if ($request->hasFile('book_image')) {
            $file = $request->book_image;
            $urlFile = $file->getRealPath();
            $nameFile = $file->getClientOriginalName();

            $arrImage = $this->uploadImage($urlFile, $nameFile);
            // echo $urlFile;
            if ($arrImage['status'] == 'ok') {
                $urlBookImage = $arrImage['url'];

                $book = Book::where('book_id', $id)
                    ->update(
                        array_merge($request->only(
                            'name_book',
                            'type_id',
                            'author',
                            'translator',
                            'publisher',
                            'publication_date',
                            'country_id',
                            'price',
                            'isbn',
                            'review',
                            'book_image'
                        ), ['book_image' => $urlBookImage])

                    );
            }
        } else {
            $book = Book::where('book_id', $id)
                ->update(
                    $request->only(
                        'name_book',
                        'type_id',
                        'author',
                        'translator',
                        'publisher',
                        'publication_date',
                        'price',
                        'isbn',
                        'review',
                    )
                );
        }



        if (!$book) {
            return response()->json([
                'status' => 'error',
                'messenger' => "Cập nhật sách thất bại",
            ], 400);
        }

        $bookinfo = Book::where('book_id', $id)->first();

        $types = Type::all();
        // $type = $this->getTypeOfBook($bookinfo, $types);
        // $bookinfo->type = $type;


        return response()->json([
            'status' => 'ok',
            'messenger' => "Cập nhật sách thành công",
            'book' => $bookinfo,
        ], 200);
    }



    public function destroy($id)
    {
        $countBook = Book::where('book_id', $id)->count();
        if ($countBook == 0) {
            return response()->json([
                'status' => 'error',
                'messenger' => 'Sách không tồn tại'
            ], 400);
        }

        // $types = Type::all();
        // $type = $this->getTypeOfBook($book, $types);
        // $book->type = $type;
        Book::where('book_id', $id)->delete();
        BorrowingBook::where('book_id', $id)->delete();
        return response()->json([
            'status' => 'ok',
            'messenger' => 'Xoá sách thành công'
        ], 200);
    }


    // lấy sách phát hành theo ngày mới nhất
    public function getLatestBooks(Request $request)
    {
        $limit = 10;
        if ($request->has('limit')) {
            $limit = $request->get('limit');
        }

        $books = Book::filter($request->all())->orderBy('publication_date', 'desc')->limit($limit)->get();
        $types = Type::all();
        foreach ($books as $book) {
            // $type = $this->getTypeOfBook($book, $types);
            // $book->type = $type;
            $book->borrowing = BorrowingBook::where([['book_id', $book->book_id], ['status_id', 1]])->count() != 0;
        }
        return response()->json(
            [
                'orderBy' => 'desc',
                'books' => $books
            ],
            200
        );
    }


    // lấy list book đc mượn nhiều nhất
    public function topBorrowing(Request $request)
    {
        $limit = 10;
        if ($request->has('limit')) {
            $limit = $request->get('limit');
        }
        $books = BorrowingBook::select(BorrowingBook::raw('COUNT(borrowing_books.book_id) as count, borrowing_books.book_id'))
            ->groupBy('borrowing_books.book_id')
            ->orderByDesc('count')
            ->limit($limit)->get();


        // $types = Type::all();
        foreach ($books as $book) {
            $bookinfo = Book::where('book_id', $book->book_id)->first();
            $bookinfo->borrowing = BorrowingBook::where([['book_id', $book->book_id],['status_id', 1]])->count() != 0;

            // $type = $this->getTypeOfBook($bookinfo, $types);
            // $bookinfo->type = $type;
            $book->book = $bookinfo;
        }

        return response()->json(
            [
                'orderBy' => 'desc',
                "books" => $books,
            ],
            200
        );
    }

    public function getTypeOfBook($book, $types)
    {


        $type3 = $types->find($book->type_id);
        $type2 = $types->where('type_id', $type3->parent_id)->first();
        $type1 = $types->where('type_id', $type2->parent_id)->first();
        $type = (object) [];
        if ($type3->code % 100 < 10) {
            $type->level_3 = $type3;
            $type->level_1 = $type2;
        } else {
            $type->level_1 = $type1;
            $type->level_2 = $type2;
            $type->level_3 = $type3;
        }
        return $type;
    }

    public function uploadImage($urlFile, $nameFile)
    {
        $nameFile = substr($nameFile, 0, 100);

        $url = "https://api.imgbb.com/1/upload?key=ba4b149d644934850a218ea3aa6ede0b";
        $file = file_get_contents($urlFile);

        // $filebase64 =  base64_encode($file);

        $client = new Client();
        $res = $client->request('POST', $url, [
            'multipart' => [
                [
                    'name'     => 'image',
                    'filename' => $nameFile,
                    'Mime-Type' => 'multipart/form-data',
                    'contents' => $file,
                ],
            ],
        ]);

        if (File::exists($urlFile)) {
            File::delete($urlFile);
        }

        if ($res->getStatusCode() == 200) {
            return [
                'status' => 'ok',
                'url' => json_decode($res->getBody())->data->url,
                // 'res' => $res->getBody()
            ];
        }

        return ['status' => 'error'];

        // echo json_encode($json);
        // {"type":"User"...'
    }




    public function filterByType(Request $request)
    {
        $Type = Type::where('type_id', $request->type_id)->first();
        $types = Type::all();
        $queue = [];
        $arr = [];
        array_push($arr, $Type);
        array_push($queue, $Type);
        while ($queue != null) {
            $Type = array_shift($queue);
            foreach ($types as $type) {
                if ($type->parent_id == $Type->type_id) {
                    array_push($queue, $type);;
                    array_push($arr, $type);
                }
            }
        }
        $result = [];
        foreach ($arr as $element) {
            if ($element->level == 3) {
                array_push($result, $element->type_id);
            }
        }
        return $result;
    }
}
