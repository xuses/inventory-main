<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LokasiController extends Controller
{
    //
    public function index()
    {
        $data["title"] = "Tujuan";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Tujuan', 'tbl_akses.akses_type' => 'create'))->count();
        return view('Admin.Tujuan.index', $data);
    }
}
