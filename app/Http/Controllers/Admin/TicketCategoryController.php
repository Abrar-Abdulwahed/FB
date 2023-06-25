<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TicketCategory;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=TicketCategory::paginate(5);
        return view("admin.tickets.category.index",compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.tickets.category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        TicketCategory::create([
            "name"=>$request->name,
        ]);

        return redirect()->route("admin.TicketsCategory.index")
        ->with('success','تم اضافه النوع بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category=TicketCategory::findOrfail($id);
        return view("admin.tickets.category.edit",compact('category'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $category=TicketCategory::findOrfail($id);
        if ($category) {
            $category->update($request->all());
            return redirect()->route('admin.TicketsCategory.index')
            ->with('success', 'تم تعديل النوع بنجاح');   
         }else{
            return redirect()->route("admin.TicketsCategory.index")
            ->with('eroorr','لم يتم التعديل بنجاح');    
                 }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category=TicketCategory::findOrfail($id);
        if ($category) {
            $category->delete();
            return redirect()->route('admin.TicketsCategory.index')
            ->with('success', 'تم حذف النوع بنجاح');   
        }else{
            return redirect()->route("admin.TicketsCategory.index")
            ->with('eroorr','لم يتم الحذف بنجاح');    
         }
    }
}
