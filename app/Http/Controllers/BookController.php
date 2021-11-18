<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Type;
use App\Models\Country;
use App\Http\Requests\BookRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Rental;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Client;
use SebastianBergmann\Environment\Console;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'check-role'], ['only' => ['store', 'update', 'destroy']]);
    }

    public function index(Request $request)
    {
        $books = Book::with('type', 'country')->filter($request->all())->get();
        return $books;
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
        return response()->json([
            'book' => $book,
        ], 200);
    }


    public function show($id)
    {
        if (Book::where('_id', $id)->count() == 0) {
            return response()->json([
                'status' => 'error',
                'messenger' => 'Sách không tồn tại'
            ], 422);
        }

        $book = Book::where('_id', $id)->with('type', 'country')->first();
        return $book;
    }

    public function update(BookUpdateRequest $request, $id)
    {
        if (Book::where('_id', $id)->count() == 0) {
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

                $book = Book::where('_id', $id)
                    ->update(
                        array_merge($request->only(
                            'name',
                            'type_id',
                            'author',
                            'publisher',
                            'publication_year',
                            'country_id',
                            'book_image'
                        ), ['book_image' => $urlBookImage])

                    );
            }
        } else {
            $book = Book::where('book_id', $id)
                ->update(
                    $request->only(
                        'name',
                        'type_id',
                        'author',
                        'publisher',
                        'publication_year',
                        'country_id',
                        'book_image'
                    )
                );
        }

        if (!$book) {
            return response()->json([
                'status' => 'error',
                'messenger' => "Cập nhật sách thất bại",
            ], 400);
        }

        $bookinfo = Book::where('_id', $id)->first();

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
        $countBook = Book::where('_id', $id)->count();
        if ($countBook == 0) {
            return response()->json([
                'status' => 'error',
                'messenger' => 'Sách không tồn tại'
            ], 400);
        }

        Book::where('_id', $id)->delete();
        return response()->json([
            'status' => 'ok',
            'messenger' => 'Xoá sách thành công'
        ], 200);
    }

    // lấy list book đc mượn nhiều nhất
    public function topBorrowing(Request $request)
    {
        $limit = 10;
        if ($request->has('limit')) {
            $limit = $request->get('limit');
        }
        //$result = Book::groupBy('type_id')->get(['publication_year', 'name']);
        $result = Book::raw(function($collection){
            return $collection->aggregate(array(
                array(
                    '$group' => array(
                        '_id' => '$type_id',
                        'count' => array(
                            '$sum' => 1
                        )
                    )
                )
            ));
        })->getDictionary();
        $s = array_values($result);
        //usort($s, "count");
        //var_dump($result);
        return $result;
        $books = Rental::select(Rental::raw('COUNT(borrowing_books.book_id) as count, borrowing_books.book_id'))
            ->groupBy('rentals.book_id')
            ->orderByDesc('count')
            ->limit($limit)->get();

        return $books;
    }

    public function getLatestBooks(Request $request)
    {
        $limit = 5;
        if ($request->has('limit')) {
            $limit = $request->get('limit');
        }
        $books = Book::with('country', 'type')->filter($request->all())
            ->orderByDesc('created_at')
            ->limit($limit)->get();

        return $books;
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
}