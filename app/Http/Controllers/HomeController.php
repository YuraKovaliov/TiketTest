<?php

namespace App\Http\Controllers;

use App\Models\testTi;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

//        return view('home', ['data' => testTi::all()]);
        if(Auth::user()->email === testTi::where()->user_email)
        $data = testTi::where('ticketPriority', 'like', '%Open%')->get();
        return view('home', ['data' => $data]);
//        if (testTi::where('user_email') === Auth::user()->email) {
//            $data = testTi::where('ticketPriority', 'like', '%Open%')
//                ->orderBy('created_at', 'desc')
//                ->get();
//            return view('home', ['data' => $data]);
//        }
    }
//
//
//        $exists = testTi::where('remember_token', Auth::user()->remember_token)->exists();
//
//        if ($exists) {
//            // Если запись найдена, получаем данные с определенным приоритетом
//            $data = testTi::where('ticketPriority', 'like', '%Open%')
//                ->orderBy('created_at', 'desc')
//                ->get();
//
//            // Возвращаем представление с данными
//            return view('home', ['data' => $data]);
//        }


        // Проверка, авторизован ли пользователь

//        $email = Auth::user()->email;
//
//        // Получаем запись по email
//        $record = testTi::where('user_email', $email)->first();
//            if(){
//
//            }
//    }

//            // Проверяем, существует ли запись
//            if ($record) {
//                // Получаем данные с определенным приоритетом
//                $data = testTi::where('user_email', $email)  // Проверяем пользователя
//                ->where('ticketPriority', 'like', '%Close%')
//                    ->orderBy('created_at', 'desc')
//                    ->get();
//
//                // Возвращаем представление с данными
//                return view('home', ['data' => $data]);
//            } else {
//                // Если запись не найдена, возвращаем сообщение об ошибке
//                return redirect()->back()->withErrors(['error' => 'Запись с указанным email не найдена.']);
//            }
//        }




    public function closeTiket()
    {
//        $data = testTi::where('ticketPriority', 'like', '%Close%')
//            ->orderBy('created_at', 'desc') // Используйте orderBy до get()
//            ->get();
//        return view('home', ['data' => $data]);
        if (Auth::check()) {
            $email = Auth::user()->email;

            // Получаем запись по email
            $record = testTi::where('user_email', $email)->first();

            // Проверяем, существует ли запись
            if ($record) {
                // Получаем данные с определенным приоритетом
                $data = testTi::where('ticketPriority', 'like', '%Close%')
                    ->orderBy('created_at', 'desc')
                    ->get();

                // Возвращаем представление с данными
                return view('home', ['data' => $data]);
            } else {
                // Если запись не найдена, возвращаем сообщение об ошибке
                return redirect()->back()->withErrors(['error' => 'Запись с указанным email не найдена.']);
            }
        } else {
            // Если пользователь не авторизован, перенаправляем на страницу входа
            return redirect()->route('login')->withErrors(['error' => 'Пожалуйста, войдите в систему.']);
        }
    }



    public function createTiket()
    {
           return view('createTiket');

    }

    public function submitForm(Request $request)
    {

        $valid =$request->validate([
            'ticketTitle' => 'required|min:4|max:20',
            'ticketDescription' => 'required|min:4',
            'ticketPriority' => 'required|min:1',
        ],[
            'ticketTitle.required' => 'Поле "Заголовок тикета" обязательно для заполнения.',
            'ticketTitle.min' => 'Поле "Заголовок тикета" должно содержать минимум :min символа.',
            'ticketTitle.max' => 'Поле "Заголовок тикета" должно содержать максимум :max символов.',

            'ticketDescription.required' => 'Поле "Описание" обязательно для заполнения.',
            'ticketDescription.min' => 'Поле "Описание" должно содержать минимум :min символа.',
            'ticketDescription.max' => 'Поле "Описание" должно содержать максимум :max символов.',

            'ticketPriority.required' => 'Поле "Статус" обязательно для заполнения.',
            'ticketPriority.min' => 'Поле "Статус" должно содержать минимум :min символа.',
        ]);

        $check = new testTi();
        $check->ticketTitle = $request->input('ticketTitle');
        $check->ticketDescription = $request->input('ticketDescription');
        $check->ticketPriority = $request->input('ticketPriority');
        $check->user_email = Auth::user()->email;

        $check->save();

        return redirect()->route('home')->with('success', 'Тикет успешно создан!');
    }

    public function close($id)
    {
        $ticket = testTi::find($id);
        $ticket->ticketPriority = 'Closed';
        $ticket->save();

        return redirect()->back();
    }
    public function opentiket($id)
    {
        $ticket = testTi::find($id);
        $ticket->ticketPriority = 'Open';
        $ticket->save();

        return redirect()->back();
    }


    public function delete($id)
    {
        $ticket = testTi::find($id);
        $ticket->delete();

        return redirect()->back();
    }
}
