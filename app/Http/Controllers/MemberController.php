<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class MemberController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Member/Index', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function create(Request $request): Response
    {
        return Inertia::render('Member/Create', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function show(Request $request, $id): Response
    {
        $member = Member::find($id);
        return Inertia::render('Member/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'dataMember'=> $member
        ]);
    }

    public function delete($id)
    {
        $member = Member::find($id);
        if ($member != null) {
            return Inertia::render('Member/Delete', [
                'memberId' => $id
            ]);
        } else {
            return Redirect::route('member.index');
        }
    }

    public function allMember(Request $request) {
        $members = Member::get();
        return response()->json(['data'=> $members, 'status'=> 200]);
    }

    public function createMember(Request $request) {
        try {
            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required|unique:members,phone',
                'email' => 'required|email|unique:members,email',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
                'status' => 'error',
            ], 422);
        }

        try {
            $member = Member::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);

            return response()->json([
                'message' => 'Anggota berhasil ditambahkan.',
                'status' => 'success',
                'data' => $member,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e,
                'status' => 'error',
            ], 500);
        }
    }

    public function updateMember(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
                'status' => 'error',
            ], 422);
        }

        try {
            $member = Member::find($id);
            $member->fill($request->only([
                'name',
                'address',
                'phone',
                'email',
            ]));

            if ($member->isDirty()) {
                $member->save();
                return response()->json([
                    'message' => 'Anggota berhasil diupdate.',
                    'status' => 'success',
                    'data' => $member,
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Tidak ada data yang berubah',
                    'status' => 'error',
                ], 500);
            }

        } catch (\Illuminate\Database\QueryException $e) {

            if ($e->errorInfo[1] === 1062) {
                return response()->json([
                    'message' => 'Gagal memperbarui anggota. Nama/Email/Telepon sudah ada yang menggunakan.',
                    'status' => 'error',
                ], 409);
            }

            return response()->json([
                'message' => $e,
                'status' => 'error',
            ], 500);
        }
    }

    public function deleteMember($id)
    {
        try {
            $member = Member::findOrFail($id);
            $member->delete();

            return response()->json([
                'message' => 'Anggota berhasil dihapus.',
                'status' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error',
            ], 500);
        }
    }
}
