<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
// use App\Models\Admin\CustomerModel;
use App\Models\Admin\TujuanModel;
use App\Models\Admin\BarangModel;
use App\Models\Admin\BarangkeluarModel;
use App\Models\Admin\BarangmasukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class TujuanController extends Controller
{
    public function index()
    {
        $data["title"] = "Tujuan";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.menu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_menu.menu_judul' => 'Lokasi', 'tbl_akses.akses_type' => 'create'))->count();
        // $data["lokasi_nama"] =  TujuanModel::orderBy('lokasi_nama', 'DESC')->get();
        return view('Admin.Tujuan.index', $data);
    }
    
    public function gettujuan($id)
    {
        $data = TujuanModel::where('tbl_lokasi.bk_tujuan', '=', $id)->get();
        return json_encode($data);
    }

    public function show(Request $request)
    {
        if (($request->ajax())) {
            $data = TujuanModel::orderBy('lokasi_id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('Tujuan', function ($row) {
                    $tujuan = $row->bk_tujuan == '' ? '-' : $row->bk_tujuan;
                    return $tujuan;
                })
                ->addColumn('Nama Tujuan', function ($row) {
                    $nama_tujuan = $row->lokasi_nama == '' ? '-' : $row->lokasi_nama;
                    return $nama_tujuan;
                })
                ->addColumn('Alamat', function ($row) {
                    $nama_tujuan = $row->lokasi_nama == '' ? '-' : $row->lokasi_nama;
                    return $nama_tujuan;
                })
                ->addColumn('action', function ($row) {
                    $array = array(
                        "lokasi_id" => $row->lokasi_id,
                        "bk_tujuan" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->bk_tujuan)),
                        "lokasi_nama" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->lokasi_nama)),
                        "lokasi_alamat" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_',$row->lokasi_alamat))
                    );
                    $button = '';
                    $hakEdit = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.menu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_menu.menu_judul' => 'Lokasi', 'tbl_akses.akses_type' => 'update'))->count();
                    $hakDelete = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.menu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_menu.menu_judul' => 'Lokasi', 'tbl_akses.akses_type' => 'delete'))->count();
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
                ->make(true);
        }
    }

    public function listtujuan(Request $request)
    {
        if ($request->ajax()) {
            // $data = BarangModel::leftJoin('tbl_jenisbarang', 'tbl_jenisbarang.jenisbarang_id', '=', 'tbl_barang.jenisbarang_id')->leftJoin('tbl_satuan', 'tbl_satuan.satuan_id', '=', 'tbl_barang.satuan_id')->leftJoin('tbl_merk', 'tbl_merk.merk_id', '=', 'tbl_barang.merk_id')->orderBy('barang_id', 'DESC')->get();
            $data = TujuanModel::orderBy('lokasi_id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('Tujuan', function ($row) {
                    $tujuan = $row->bk_tujuan == '' ? '-' : $row->bk_tujuan;
                    return $tujuan;
                })

                ->addColumn('Nama Tujuan', function ($row) {
                    $nama_tujuan = $row->lokasi_nama == '' ? '-' : $row->lokasi_nama;
                    return $nama_tujuan;
                })

                ->addColumn('Alamat', function ($row) {
                    $nama_tujuan = $row->lokasi_nama == '' ? '-' : $row->lokasi_nama;
                    return $nama_tujuan;
                })

                ->addColumn('action', function ($row) use ($request) {
                    $array = array(
                        "lokasi_id" => $row->lokasi_id,
                        "bk_tujuan" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->bk_tujuan)),
                        "lokasi_nama" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->lokasi_nama)),
                        "lokasi_alamat" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_',$row->lokasi_alamat))
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
                ->make(true);
        }
    }


    public function proses_tambah(Request $request)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->lokasi_nama)));

        //insert data
        TujuanModel::create([
            'bk_tujuan' => $request->bk_tujuan,
            'lokasi_nama' => $request->lokasi_nama,
            'lokasi_slug' => $slug,
            'lokasi_alamat' => $request->lokasi_alamat,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_ubah(Request $request, TujuanModel $tujuan)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->alamat)));

        //update data
        $tujuan->update([
            'bk_tujuan' => $request->bk_tujuan,
            'customer_slug' => $slug,
            'customer_notelp' => $request->notelp,
            'customer_alamat' => $request->alamat,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }


    public function proses_hapus(Request $request, TujuanModel $tujuan)
    {
        //delete
        $tujuan->delete();

        return response()->json(['success' => 'Berhasil']);
    }


}
