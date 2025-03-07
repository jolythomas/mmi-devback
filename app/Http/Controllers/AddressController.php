<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Addresses/Index', [
            'addresses' => $request->user()->addresses()->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Addresses/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'is_default' => 'boolean',
        ]);

        $address = $request->user()->addresses()->create($validated);

        if ($validated['is_default'] ?? false) {
            $request->user()->addresses()
                ->where('id', '!=', $address->id)
                ->update(['is_default' => false]);
        }

        return redirect()->route('addresses.index')
            ->with('message', 'Adresse créée avec succès');
    }

    public function show(string $id)
    {
        //
    }


    public function edit(Request $request, Address $address)
    {
        if ($address->user_id !== $request->user()->id) {
            abort(403);
        }

        return Inertia::render('Addresses/Edit', [
            'address' => $address
        ]);
    }

    public function update(Request $request, Address $address)
    {
        if ($address->user_id !== $request->user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'is_default' => 'boolean',
        ]);

        $address->update($validated);

        if ($validated['is_default'] ?? false) {
            $request->user()->addresses()
                ->where('id', '!=', $address->id)
                ->update(['is_default' => false]);
        }

        return redirect()->route('addresses.index')
            ->with('message', 'Adresse mise à jour avec succès');
    }

    public function destroy(Request $request, Address $address)
    {
        if ($address->user_id !== $request->user()->id) {
            abort(403);
        }

        $address->delete();

        return redirect()->route('addresses.index')
            ->with('message', 'Adresse supprimée avec succès');
    }
}
