<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Bid;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showalluser()
    {
        $data = User::orderBy('role', 'DESC')->get();
        return response($data, 201);
    }
    public function showteknisi()
    {
        $data = User::where('role', 'teknisi')->get();
        return response($data, 201);
    }
    public function createProject(Request $request)
    {
        $project = new project;
        $project->judul = $request->input('judul');
        $project->user_id = $request->input('user_id');
        $project->harga_awal = $request->input('harga_awal');
        $project->deskripsi = $request->input('deskripsi');
        $project->lokasi = $request->input('lokasi');
        $project->jenis = $request->input('jenis');
        $project->harga_fix = $request->input('harga_fix');
        $project->status = $request->input('status');
        $project->tanggal_akhir_bid = $request->input('tanggal_akhir_bid');
        $project->save();
        return response($project, 201);
    }
    public function updateProject(Request $request)
    {
        $project_id = $request->id;
        project::where('id', $project_id)->update([
            'judul' => $request->input('judul'),
            'user_id' => $request->input('user_id'),
            'harga_awal' => $request->input('harga_awal'),
            'deskripsi' => $request->input('deskripsi'),
            'lokasi' => $request->input('lokasi'),
            'jenis' => $request->input('jenis'),
            'harga_fix' => $request->input('harga_fix'),
            "status" => $request->input('status'),
            'tanggal_akhir_bid' => $request->input('tanggal_akhir_bid'),
        ]);
        return response(200);
    }
    public function deleteProject(Request $request)
    {
        $project = project::find($request->id);
        $project->forceDelete();
        return response('project Deleted', 200);
    }
    public function getproject(Request $request)
    {
        $id = $request->id;
        $response = project::findOrFail($id);
        return response($response, 201);
    }
    public function showBidproject(Request $request)
    {
        $bid = bid::where('project_id', $request->project_id)->orderBy('created_at', 'DESC')->get();
        return response($bid, 201);
    }
    public function showallBid(Request $request)
    {
        $bid = bid::orderBy('created_at', 'DESC')->get();
        return response($bid, 201);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
