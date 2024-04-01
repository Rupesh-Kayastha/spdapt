<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Settings;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyEmail;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $messages=Message::paginate(20);
        return view('backend.message.index')->with('messages',$messages);
    }
    public function messageFive()
    {
        $message=Message::whereNull('read_at')->limit(5)->get();
        return response()->json($message);
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
        if($request->type=='R') {
            
            $this->validate($request,[
                'first_name'=>'string|required|min:2',
                'last_name'=>'string|required|min:2',
                'email'=>'email|required'
            ]);
           $subject="Product Return"; 
        } else {
            $this->validate($request,[
            'first_name'=>'string|required|min:2',
            'email'=>'email|required',
           // 'message'=>'required|min:20|max:200',
            'subject'=>'string|required',
        ]);
        }
        
        //get admin email from  general settings
        $general_setting = Settings::where('id', '1')->pluck('email');
        $emailValue = $general_setting[0];
        
        $data=array();
        $data['url']                 =url()->current();
        $data['type']                =$request->type;
        $data['first_name']          =$request->first_name;
        $data['last_name']           =$request->last_name;
        $data['email']               =$request->email;
        $data['phone']               =$request->phone;
        $data['message']             =$request->message;
        $data['subject']             =$request->subject;
        $data['company_name_address']=$request->company_name_address;
        $data['order_notes']         =$request->order_notes;
        
        $message_insert=Message::create($data);

        if($message_insert) { 
            $datais = [
                'name'          => $data['first_name'],
                'email'         => $data['email'],
                'company_name'   => $data['company_name_address'],
                'messages'       => $data['message'],
                'to'            => $emailValue,            
                'subject'       => $data['subject'],
                'type'          => $data['type'],
                'admin_email'   => $request->admin_email
            ];
            // Mail::send('mail.partners',$datais, function($messages) use ($datais){
            //     $messages->to($datais['to']);
            //     $messages->subject($datais['subject']);
            // });

           
            Mail::send('mail.contact',$datais, function($messages) use ($datais){
                $messages->to($datais['admin_email']);
                $messages->subject($datais['subject']);
            });

           // Mail::to($datais['admin_email'])->send(new MyEmail($datais));

        return redirect()->route('thanks');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $message=Message::find($id);
        if($message){
            $message->read_at=\Carbon\Carbon::now();
            $message->save();
            return view('backend.message.show')->with('message',$message);
        }
        else{
            return back();
        }
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
        $message=Message::find($id);
        $status=$message->delete();
        if($status){
            request()->session()->flash('success','Successfully deleted message');
        }
        else{
            request()->session()->flash('error','Error occurred please try again');
        }
        return back();
    }

    public function affiliates_enquiry()
    {
        $message=Message::where('type','A')->paginate(10);
        return view('backend.affiliates.index')->with('messages',$message);
    }
}
