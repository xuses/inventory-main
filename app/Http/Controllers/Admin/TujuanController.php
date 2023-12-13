<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
//use App\Models\Admin\TujuankeluarModel;
//use App\Models\Admin\TujuanmasukModel;
use App\Models\Admin\TujuanModel;
//use App\Models\Admin\JenisTujuanModel;
//use App\Models\Admin\MerkModel;
//use App\Models\Admin\SatuanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TujuanController extends Controller
{
    public function index()
    {
        $data["title"] = "Tujuan";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Tujuan', 'tbl_akses.akses_type' => 'create'))->count();
        return view('Admin.Tujuan.index', $data);
    }

    public function gettujuan($id)
    {
        $data = TujuanModel::orderBy('tujuan_id')->get();
        return json_encode($data);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {

            $data = TujuanModel::orderBy('tujuan_id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kode', function ($row) {
                    $kode = $row->tujuan_kode == '' ? '-' : $row->tujuan_kode;

                    return $kode;
                })
                ->addColumn('nama', function ($row) {
                    $nama = $row->tujuan_nama == '' ? '-' : $row->tujuan_nama;

                    return $nama;
                })
                ->addColumn('alamat', function ($row) {
                    $alamat = $row->tujuan_alamat == '' ? '-' : $row->tujuan_alamat;

                    return $alamat;
                })
                ->addColumn('action', function ($row) {
                    $array = array(
                        //"tujuan_id" => $row->tujuan_id,
                        //"jenistujuan_id" => $row->jenistujuan_id,
                        //"satuan_id" => $row->satuan_id,
                        //"merk_id" => $row->merk_id,
                        "tujuan_id" => $row->tujuan_id,
                        "tujuan_kode" => $row->tujuan_kode,
                        "tujuan_nama" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->tujuan_nama)),
                        "tujuan_alamat" => $row->tujuan_alamat,
                        //"tujuan_stok" => $row->tujuan_stok,
                        //"tujuan_gambar" => $row->tujuan_gambar,
                    );
                    $button = '';
                    $hakEdit = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Tujuan', 'tbl_akses.akses_type' => 'update'))->count();
                    $hakDelete = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Tujuan', 'tbl_akses.akses_type' => 'delete'))->count();
                    if ($hakEdit > 0 && $hakDelete > 0) {
                        $button .= '
                        <div class="g-2">
                        <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick=update(' . json_encode($array) . ')><span class="fe fe-edit text-success fs-14"></span></a>
                        <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Hmodaldemo8" onclick=hapus(' . json_encode($array) . ')><span class="fe fe-trash-2 fs-14"></span></a>
                        </div>
                        ';
                    } else if ($hakEdit > 0 && $hakDelete == 0) {
                        $button .= '
                        <div class="g-2">
                            <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick=update(' . json_encode($array) . ')><span class="fe fe-edit text-success fs-14"></span></a>
                        </div>
                        ';
                    } else if ($hakEdit == 0 && $hakDelete > 0) {
                        $button .= '
                        <div class="g-2">
                        <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Hmodaldemo8" onclick=hapus(' . json_encode($array) . ')><span class="fe fe-trash-2 fs-14"></span></a>
                        </div>
                        ';
                    } else {
                        $button .= '-';
                    }

                    return $button;
                })
                ->rawColumns(['action', 'nama', 'alamat'])->make(true);
        }
    }

    public function listtujuan(Request $request)
    {
        if ($request->ajax()) {
            $data = TujuanModel::orderBy('tujuan_id')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kode', function ($row) {
                    $kode = $row->tujuan_kode == '' ? '-' : $row->tujuan_kode;

                    return $kode;
                })
                ->addColumn('nama', function ($row) {
                    $nama = $row->tujuan_nama == '' ? '-' : $row->tujuan_nama;

                    return $nama;
                })
                ->addColumn('alamat', function ($row) {
                    $alamat = $row->tujuan_alamat == '' ? '-' : $row->tujuan_alamat;

                    return $alamat;
                })
                ->addColumn('action', function ($row) use ($request) {
                    $array = array(
                        "tujuan_kode" => $row->tujuan_kode,
                        "tujuan_nama" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->tujuan_nama)),
                        "tujuan_alamat" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->tujuan_alamat)),
                    );
                    $button = '';
                    if ($request->get('param') == 'tambah') {
                        $button .= '
                        <div class="g-2">
                            <a class="btn btn-primary btn-sm" href="javascript:void(0)" onclick=pilihTujuan(' . json_encode($array) . ')>Pilih</a>
                        </div>
                        ';
                    } else {
                        $button .= '
                    <div class="g-2">
                        <a class="btn btn-success btn-sm" href="javascript:void(0)" onclick=pilihTujuanU(' . json_encode($array) . ')>Pilih</a>
                    </div>
                    ';
                    }

                    return $button;
                })
                ->rawColumns(['action', 'kode', 'nama', 'alamat'])->make(true);
        }
    }

    public function proses_tambah(Request $request)
    {
        //$img = "";
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->nama)));

        //upload image
        // if ($request->file('foto') == null) {
        //     $img = "image.png";
        // } else {
        //     $image = $request->file('foto');
        //     $image->storeAs('public/tujuan/', $image->hashName());
        //     $img = $image->hashName();
        // }


        //create
        TujuanModel::create([
            //'tujuan_gambar' => $img,
            //'jenistujuan_id' => $request->jenistujuan,
            //'satuan_id' => $request->satuan,
            //'merk_id' => $request->merk,
            'tujuan_kode' => $request->kode,
            'tujuan_nama' => $request->nama,
            'tujuan_slug' => $slug,
            'tujuan_alamat' => $request->alamat,
            //'tujuan_stok' => 0,

        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_ubah(Request $request, TujuanModel $tujuan)
    {

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->nama)));

        //check if image is uploaded
        // if ($request->hasFile('foto')) {

        //     //upload new image
        //     $image = $request->file('foto');
        //     $image->storeAs('public/tujuan', $image->hashName());

        //     //delete old image
        //     Storage::delete('public/tujuan/' . $tujuan->tujuan_gambar);

            //update data with new image
        $tujuan->update([
            //'tujuan_gambar'  => $image->hashName(),
            //'jenistujuan_id' => $request->jenistujuan,
            //'satuan_id' => $request->satuan,
            //'merk_id' => $request->merk,
            'tujuan_kode' => $request->kode,
            'tujuan_nama' => $request->nama,
            'tujuan_slug' => $slug,
            'tujuan_alamat' => $request->alamat,
            //'tujuan_stok' => $request->stok,
        ]);
        // } else {
        //     //update data without image
        //     $tujuan->update([
        //         'jenistujuan_id' => $request->jenistujuan,
        //         'satuan_id' => $request->satuan,
        //         'merk_id' => $request->merk,
        //         'tujuan_kode' => $request->kode,
        //         'tujuan_nama' => $request->nama,
        //         'tujuan_slug' => $slug,
        //         'tujuan_harga' => $request->harga,
        //         'tujuan_stok' => $request->stok,
        //     ]);
        // }

        return response()->json(['success' => 'Berhasil']);
    }


    public function proses_hapus(Request $request, TujuanModel $tujuan)
    {
        //delete image
        //Storage::delete('public/tujuan/' . $tujuan->tujuan_gambar);

        //delete
        $tujuan->delete();

        return response()->json(['success' => 'Berhasil']);
    }
}
