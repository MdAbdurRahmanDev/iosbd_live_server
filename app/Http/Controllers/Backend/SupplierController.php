<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Session;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;

class SupplierController extends Controller
{

	/*=================== Start BrandView Methoed ===================*/
    public function SupplierView(){

        if(Auth::guard('admin')->user()->role_type  != '1' && Auth::guard('admin')->user()->role != '2'){
            abort(404);
        }

    	$suppliers = Supplier::latest()->get();
    	return view('backend.supplier.supplier_view',compact('suppliers'));

    }

    public function create()
    {
        if(Auth::guard('admin')->user()->role_type != '1' && Auth::guard('admin')->user()->role != '2'){
            abort(404);
        }

        return view('backend.supplier.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        $supplier = Supplier::where('phone',$request->phone)->first();

        if($supplier){
            $notification = array(
                'message' => 'Supplier Phone Already Created.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }else{
            Supplier::insert([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'status' => $request->status,
                'created_by' => Auth::guard('admin')->user()->id,
            ]);

            Session::flash('success','Supplier Inserted Successfully');
            return redirect()->route('supplier.all');
        }
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.edit',compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);

        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        Supplier::findOrFail($id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'status' => $request->status,
            'created_by' => Auth::guard('admin')->user()->id,
        ]);

        Session::flash('success','Supplier Updated Successfully');
        return redirect()->route('supplier.all');
    }

    public function destroy($id)
    {
        // dd($id);
        Supplier::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Supplier Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }


    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $supplier = Supplier::find($id);
        $supplier->status = 1;
        $supplier->save();

        $notification = array(
            'message' => 'Supplier Active Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function inactive($id){
        $supplier = Supplier::find($id);
        $supplier->status = 0;
        $supplier->save();

        $notification = array(
            'message' => 'Supplier Inactive Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function supplierPdf()
    {
        $dompdf = new Dompdf();
        if(Auth::guard('admin')->user()->role_type != '1' && Auth::guard('admin')->user()->role != '2'){
            abort(404);
        }

    	$suppliers = Supplier::latest()->get();

        $html = '<h1>Customer List</h1>';
        $html .= '<div class="table-responsive-sm">';
        $html .= '<table border="1" cellpadding="5" cellspacing="0" width="100%">';
        $html .= '<thead>
                    <tr>
                        <th scope="col">Sl</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                    </tr>
                </thead>';
        $html .= '<tbody>';

        foreach ($suppliers as $key => $supplier) {
            $html .= '<tr>';
            $html .= '<td>' . ($key + 1) . '</td>';
            $html .= '<td>' . ($supplier->name ?? 'No Name') . '</td>';
            $html .= '<td>' . ($supplier->phone ?? 'No Phone Number') . '</td>';
            $html .= '<td>' . ($supplier->email ?? 'No Email') . '</td>';
            $html .= '<td>' . ($supplier->address ?? 'No Address') . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table></div>';
        $html .= '<p>Thank you for using our service!</p>';

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        return $dompdf->stream('supplier_list.pdf', [
            'Attachment' => true,
        ]);
    }
}
