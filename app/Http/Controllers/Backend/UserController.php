<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Dompdf\Dompdf;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('admin')->user()->role != '1'){
            abort(404);
        }
        $customers = User::where('role', 3)->latest()->get();
        // dd($customers);
    	return view('backend.customer.index',compact('customers'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function downloadPDF()
    {
        $dompdf = new Dompdf();

        if(Auth::guard('admin')->user()->role != '1'){
            abort(404);
        }
        $customers = User::where('role', 3)->latest()->get();

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

        foreach ($customers as $key => $customer) {
            $html .= '<tr>';
            $html .= '<td>' . ($key + 1) . '</td>';
            $html .= '<td>' . ($customer->name ?? 'No Name') . '</td>';
            $html .= '<td>' . ($customer->phone ?? 'No Phone Number') . '</td>';
            $html .= '<td>' . ($customer->email ?? 'No Email') . '</td>';
            $html .= '<td>' . ($customer->address ?? 'No Address') . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table></div>';
        $html .= '<p>Thank you for using our service!</p>';

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        return $dompdf->stream('customer_list.pdf', [
            'Attachment' => true,
        ]);
    }


}
