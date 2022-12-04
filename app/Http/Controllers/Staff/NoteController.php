<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @see \Tests\Feature\Http\Controllers\Staff\NoteControllerTest
 */
class NoteController extends Controller
{
    /**
     * Display All User Notes.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('Staff.note.index');
    }

    /**
     * Store A New User Note.
     */
    public function store(Request $request, string $username): \Illuminate\Http\RedirectResponse
    {
        $staff = $request->user();
        $user = User::where('username', '=', $username)->firstOrFail();

        $note = new Note();
        $note->user_id = $user->id;
        $note->staff_id = $staff->id;
        $note->message = $request->input('message');

        $v = \validator($note->toArray(), [
            'user_id'  => 'required',
            'staff_id' => 'required',
            'message'  => 'required',
        ]);

        if ($v->fails()) {
            return \to_route('users.show', ['username' => $user->username])
                ->withErrors($v->errors());
        }

        $note->save();

        return \to_route('users.show', ['username' => $user->username])
            ->withSuccess('Opomba je bila uspešno objavljena');
    }

    /**
     * Delete A User Note.
     *
     * @throws \Exception
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $note = Note::findOrFail($id);
        $user = User::findOrFail($note->user_id);
        $note->delete();

        return \to_route('users.show', ['username' => $user->username])
            ->withSuccess('Opomba je bila uspešno izbrisana');
    }
}
