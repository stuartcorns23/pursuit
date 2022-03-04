<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{

    public function index()
    {
        $documents = Document::all();
        return view('documents.view', compact('documents'));
    }

    public function create()
    {
        $types = Type::all();
        return view('documents.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);

        $date = \Carbon\Carbon::now()->format('dmy-his');
        $file = $request->file;
        $ext = $file->extension();
        $fileName = auth()->user()->first_name.'-'.auth()->user()->last_name.'-'.$date.'.'.$ext;

        $document =  new Document;
        $document->fill(['name' => $request->name, 'type_id' => $request->type_id, 'expiry' => $request->expiry, 'path' => 'path', 'user_id' => auth()->user()->id])->save();
        Storage::disk('public')->putFileAs('documents/', $file, $fileName);
        $document->addMediaFromUrl(Storage::disk('public')->url("documents/{$fileName}"))->toMediaCollection();
        return redirect('documents.index');
    }


    public function show(Document $document)
    {
        //
    }

    public function edit(Document $document)
    {
        //
    }

    public function update(Request $request, Document $document)
    {
        //
    }

    public function destroy(Document $document)
    {
        //
    }

    public function approve(Document $document){
        $document->checked = 1;
        $document->checked_by = auth()->user()->id;
        $document->checked_date = \Carbon\Carbon::now();
        $document->save();

        session()->flash('success_message', 'You have approved the document!');
        return redirect(route('documents.index'));
    }

    public function reject(Document $document){
        
    }
}
