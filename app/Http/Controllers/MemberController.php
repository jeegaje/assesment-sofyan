<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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
}
