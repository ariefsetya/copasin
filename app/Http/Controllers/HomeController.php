<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Auth;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function check_exp($tgl,$expires)
	{
		if($expires!=0){
		$waktu = date_format(date_create($tgl),"Y-m-d H:i:s");
		$now = date("Y-m-d H:i:s");

		$start = new \DateTimeImmutable($waktu);
		$datetime = $start->modify($expires);
		$waktu = $datetime->format('Y-m-d H:i:s');

			if($now>$waktu){
				return true;
			}
		}
	}
	public function kadal($tgl,$expires)
	{
		if($expires!=0){
		$waktu = date_format(date_create($tgl),"Y-m-d H:i:s");
		$now = date("Y-m-d H:i:s");

		$start = new \DateTimeImmutable($waktu);
		$datetime = $start->modify($expires);
		$waktu = $datetime->format('Y-m-d H:i:s');

		if($now>$waktu){
			return true;
		}
		}
		return false;
	}
	public function index()
	{
		$syntax = \App\Syntax::all();
		$expires = \App\Expires::all();
		return view('home')->with(['syntax'=>$syntax,
				'expires'=>$expires]);
	}
	public function hash($hash)
	{
		$data = \App\Copas::where('hash',$hash)->first();

		if(!empty($data)){

			if($this->check_exp($data->created_at,$data->expires)){
				return redirect(url());
			}

			return view('copasan')->with(['data'=>$data,
				'user'=>$this->get_user($data->idpengguna),
				'lang'=>$this->get_lang($data->lang),
				'exp'=>$this->get_exp($data->expires)]);
		}else{
			return redirect(url());
		}


	}	
	public function hash_edit($hash)
	{
	if(Auth::check()){
		$data = \App\Copas::where('hash',$hash)->where('idpengguna',Auth::user()->id)->first();

		if(!empty($data)){

			if($this->check_exp($data->created_at,$data->expires)){
				return redirect(url());
			}

			return view('copasan_edit')->with(['data'=>$data,
				'user'=>$this->get_user($data->idpengguna),
				'lang'=>$data->lang,
				'exp'=>$data->expires,
				'syntax'=>\App\Syntax::all(),
				'expires'=>\App\Expires::all()]);
		}else{
			return redirect(url());
		}
	}else{
			return redirect(url());
	}


	}	
	public function hash_hapus($hash)
	{
	if(Auth::check()){
		$data = \App\Copas::where('hash',$hash)->where('idpengguna',Auth::user()->id)->first();

		if(!empty($data)){

			if($this->check_exp($data->created_at,$data->expires)){
				return redirect(url());
			}

			return view('copasan_hapus')->with(['data'=>$data,
				'user'=>$this->get_user($data->idpengguna),
				'lang'=>$data->lang,
				'exp'=>$data->expires,
				'syntax'=>\App\Syntax::all(),
				'expires'=>\App\Expires::all()]);
		}else{
			return redirect(url());
		}
	}else{
			return redirect(url());
	}


	}
	public function embed($hash)
	{
		$data = \App\Copas::where('hash',$hash)->first();

		if(!empty($data)){

			if($this->check_exp($data->created_at,$data->expires)){
				return redirect(url());
			}

			return view('copasan_embed')->with(['data'=>$data,
				'user'=>$this->get_user($data->idpengguna),
				'lang'=>$this->get_lang($data->lang),
				'exp'=>$this->get_exp($data->expires)]);
		}else{
			return redirect(url());
		}


	}
	public function lapor($hash)
	{
	$data = \App\Copas::where('hash',$hash)->first();
	if(Auth::check()){

		if(!empty($data)){


			if($this->check_exp($data->created_at,$data->expires)){
				return redirect(url());
			}

			$data->spam = 1;
			$data->spam_fix = 1;
			$data->save();

			return view('copasan_lapor')->with(['data'=>$data,
				'user'=>$this->get_user($data->idpengguna),
				'lang'=>$this->get_lang($data->lang),
				'exp'=>$this->get_exp($data->expires)]);
		}else{
			return redirect(url());
		}
	}else{

			$data->spam = 1;
			$data->save();

		return view('copasan_lapor')->with(['data'=>$data,
			'user'=>$this->get_user($data->idpengguna),
			'lang'=>$this->get_lang($data->lang),
			'exp'=>$this->get_exp($data->expires)]);
	}

	}
	public function save()
	{
		$uid = uniqid('');
		if(trim(Input::get('isi'))==""){
			return redirect(url());
		}else{
		$data = new \App\Copas;
		$data->idpengguna = (Auth::check())?Auth::user()->id:0;
		$data->judul = (trim(Input::get('judul'))!="")?htmlentities(Input::get('judul')):"Tanpa Judul";
		$data->isi = htmlentities(Input::get('isi'));
		$data->lang = \App\Syntax::where('kode',Input::get('lang'))->first()['id'];
		$data->expires = Input::get('expires');
		$data->jenis = Input::get('jenis');
		$data->hash = $uid;
		$data->save();
		return redirect(url($uid));
		}
	}
	public function update()
	{
		$uid = \App\Copas::where('id',Input::get('id'))->where('idpengguna',Auth::user()->id)->first()['hash'];
		if($uid!=""){
			if(trim(Input::get('isi'))==""){
				return redirect(url(\App\Copas::find(Input::get('id')['hash'])));
			}else{
				$data = \App\Copas::find(Input::get('id'));
				$data->judul = (trim(Input::get('judul'))!="")?htmlentities(Input::get('judul')):"Tanpa Judul";
				$data->isi = htmlentities(Input::get('isi'));
				$data->lang = \App\Syntax::where('kode',Input::get('lang'))->first()['id'];
				$data->expires = Input::get('expires');
				$data->jenis = Input::get('jenis');
				$data->spam = 0;
				$data->spam_fix = 0;
				$data->save();
				return redirect(url($uid));
			}
		}else{
			return redirect(url($uid));
		}
	}
	public function hapus()
	{
		$uid = \App\Copas::where('id',Input::get('id'))->where('idpengguna',Auth::user()->id)->first()['hash'];
		if($uid!=""){
			if(trim(Input::get('isi'))==""){
				return redirect(url(\App\Copas::find(Input::get('id')['hash'])));
			}else{
				if(Input::get('judul_'.Input::get('_token'))==Input::get('judul')){
					$data = \App\Copas::find(Input::get('id'));
					$data->delete();
					return redirect(url('copasanku'));
				}else{
					return redirect(url($uid));
				}
			}
		}else{
			return redirect(url($uid));
		}
	}

	public function get_user($id)
	{
		$data = \App\User::find($id);
		if(empty($data)){
			return "anonim";
		}else{
			return $data->name;
		}
	}	
	public function get_exp($val)
	{
		$data = \App\Expires::where('waktu',$val)->first();
		return $data->info;
	}	
	public function get_lang($id)
	{
		return \App\Syntax::find($id);
	}
	public function copasan()
	{
		$data = \App\Copas::whereRaw("COALESCE(CASE SUBSTRING_INDEX(expires, ' ', -1)
			WHEN 'minute' THEN DATE_ADD((created_at), INTERVAL SUBSTRING_INDEX(expires, ' ', 1) MINUTE)
			WHEN 'hour' THEN DATE_ADD((created_at), INTERVAL SUBSTRING_INDEX(expires, ' ', 1) HOUR)
			WHEN 'day' THEN DATE_ADD((created_at), INTERVAL SUBSTRING_INDEX(expires, ' ', 1) DAY)
			WHEN 'week' THEN DATE_ADD((created_at), INTERVAL SUBSTRING_INDEX(expires, ' ', 1) WEEK)
			WHEN 'month' THEN DATE_ADD((created_at), INTERVAL SUBSTRING_INDEX(expires, ' ', 1) MONTH)
			WHEN 'year' THEN DATE_ADD((created_at), INTERVAL SUBSTRING_INDEX(expires, ' ', 1) YEAR)
			ELSE NULL END > NOW(),1)=1")->where('jenis',0)->where('spam_fix',0)->orderBy('id','desc')->paginate(20);
		//	echo "<pre>".print_r($data,1)."</pre>";
			

		return view('copasan_publik')->with(['data'=>$data]);
	}
	public function copasanku()
	{
		$data = \App\Copas::whereRaw("COALESCE(CASE SUBSTRING_INDEX(expires, ' ', -1)
			WHEN 'minute' THEN DATE_ADD((created_at), INTERVAL SUBSTRING_INDEX(expires, ' ', 1) MINUTE)
			WHEN 'day' THEN DATE_ADD((created_at), INTERVAL SUBSTRING_INDEX(expires, ' ', 1) DAY)
			WHEN 'hour' THEN DATE_ADD((created_at), INTERVAL SUBSTRING_INDEX(expires, ' ', 1) HOUR)
			WHEN 'week' THEN DATE_ADD((created_at), INTERVAL SUBSTRING_INDEX(expires, ' ', 1) WEEK)
			WHEN 'month' THEN DATE_ADD((created_at), INTERVAL SUBSTRING_INDEX(expires, ' ', 1) MONTH)
			WHEN 'year' THEN DATE_ADD((created_at), INTERVAL SUBSTRING_INDEX(expires, ' ', 1) YEAR)
			ELSE NULL END > NOW(),1)=1")->where('idpengguna',Auth::user()->id)->orderBy('id','desc')->paginate(20);
			//echo "<pre>".print_r($data,1)."</pre>";
		return view('copasanku')->with(['data'=>$data]);
	}

	public function faq()
	{
		return view('faq');
	}
	public function kita()
	{
		return view('kita');
	}
	public function gabung()
	{
		return view('gabung');
	}
	public function masuk()
	{
		return view('masuk');
	}
	public function widget()
	{
		return view('widget');
	}
	public function widgz()
	{
		$syntax = \App\Syntax::all();
		$expires = \App\Expires::all();
		return view('widget_webapp')->with(['syntax'=>$syntax,
				'expires'=>$expires]);
	}
	public function widgzsave()
	{
		$uid = uniqid('');
		if(trim(Input::get('isi'))==""){
			return redirect(url("widgz"));
		}else{
			$data = new \App\Copas;
			$data->idpengguna = (Auth::check())?Auth::user()->id:0;
			$data->judul = (trim(Input::get('judul'))!="")?htmlentities(Input::get('judul')):"Tanpa Judul";
			$data->isi = htmlentities(Input::get('isi'));
			$data->lang = \App\Syntax::where('kode',Input::get('lang'))->first()['id'];
			$data->expires = Input::get('expires');
			$data->jenis = Input::get('jenis');
			$data->hash = $uid;
			$data->save();
			return view('widgz_done')->withData($data);
		}
	}
}
