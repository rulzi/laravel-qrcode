<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;
use Endroid\QrCode\QrCode;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guests = Guest::all();

        $data = [
            'guests' => $guests
        ];

        return view('home.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'seat_number' => 'required',
            'qr_code' => 'required',
        ]);

        $guest = New Guest();

        $guest->name = $request->name;
        $guest->gender = $request->gender;
        $guest->address = $request->address;
        $guest->seat_number = $request->seat_number;
        $guest->qr_code = $request->qr_code;

        if($guest->save()){
            $request->session()->flash('success', 'Data berhasil di buat!');
        }

        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guest = Guest::find($id);

        $qrCode = new QrCode();
        $qrCode
            ->setText($guest->qr_code)
            ->setSize(300)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setLabel($guest->qr_code. ' '. $guest->name)
            ->setLabelFontSize(16)
            ->setImageType(QrCode::IMAGE_TYPE_PNG)
        ;

        // $qrCode->render();

        // save it to a file
        $qrCode->save('qrcode.png');

        return view('home.show');
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guest = Guest::find($id);

        $data = [
            'guest' => $guest,
        ];
        return view('home.edit', $data);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'seat_number' => 'required',
        ]);

        $guest = Guest::find($id);

        $guest->name = $request->name;
        $guest->gender = $request->gender;
        $guest->address = $request->address;
        $guest->seat_number = $request->seat_number;

        if($guest->save()){
            $request->session()->flash('success', 'Data berhasil di Update!');
        }

        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $guest = Guest::find($id);

        if($guest->delete()){
            $request->session()->flash('success', 'Data berhasil di hapus!');
        }

        return redirect(route('home'));
    }
}
