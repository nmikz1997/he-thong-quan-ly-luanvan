<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LichBaoVe;
use App\NienKhoa;
use App\Ngay;
use App\DiaDiem;
use App\luanvan;
use Carbon\Carbon;
use DB;

class LichController extends Controller
{

    public function index($diadiem_id,$ngay_id) // theo địa điểm
    {

        $lastNK = NienKhoa::find(NienKhoa::max('id'));
        $dsDiadiem = DiaDiem::all();
        $dsNgay = $lastNK->ngay()->get();
        $dsLich = $lastNK->lichbaove()->where('diadiem_id',$diadiem_id)->where('ngay_id',$ngay_id)->get();

        return response([
            'error' => 'false', 'message' => compact('dsNgay','dsDiadiem','dsLich')
        ]);
    }


    public function store(Request $request)
    {
        //Lấy niên khóa mới nhất
        $lastNK = NienKhoa::orderBy('id', 'DESC')->first();
        //tạo 1 ngày
        $ngay   = new Ngay();
        $carbon = new Carbon(substr($request->ngay, 0, -10));

        $ngay->ngay = $carbon->format('Y-m-d');
        $ngay->nienkhoa_id = $lastNK->id;
        $ngay->save();

        //Lấy ngày mới nhất
        $lastDate = Ngay::orderBy('ngay', 'DESC')->first();

        $dsLichRaw = DB::table('ngay')->where('ngay','=',$lastDate->ngay)->crossJoin('diadiem')->crossJoin('gio')->select('ngay.ngay as ngay_id', 'diadiem.id as diadiem_id','gio.id as gio_id')->get()->toArray();

        $data = array();
        foreach ($dsLichRaw as $lich) {
            $data[] = (array)$lich;
        }
        DB::table('lichbaove')->insert($data);

        return "Thêm thành công";

    }

    public function ChonLich($buoi, $luanvan_id)
    {
        $hoidong = $this->TimHoiDong($luanvan_id);

        if($buoi == 'S') $tiet = [1,5];
        if($buoi == 'C') $tiet = [6,10];

        // if($buoi == "S"){

            $lichTonTai = DB::table('hoidongluanvan')
                            ->whereBetween('gio_id',$tiet)
                            ->whereIn('canbo_id',$hoidong)
                            ->groupBy('hoidongluanvan.ngay_id')
                            ->pluck('ngay_id')->toArray();

            return LichBaoVe::whereBetween('gio_id',$tiet)
                    ->whereNotIn('ngay_id',$lichTonTai)
                    ->selectRaw('lichbaove.ngay_id,count(lichbaove.ngay_id) as soTiet')
                    ->groupBy('lichbaove.ngay_id')
                    ->havingRaw('soTiet > 4 ')
                    ->get();
        // }else{
        //     $lichTonTai = DB::table('hoidongluanvan')
        //                     ->whereBetween('gio_id',[6,10])
        //                     ->whereIn('canbo_id',$hoidong)
        //                     ->groupBy('hoidongluanvan.ngay_id')
        //                     ->pluck('ngay_id')->toArray();

        //     return LichBaoVe::whereBetween('gio_id',[6,10])
        //             ->whereNotIn('ngay_id',$lichTonTai)
        //             ->selectRaw('lichbaove.ngay_id, count(lichbaove.ngay_id) as soTiet')
        //             ->groupBy('lichbaove.ngay_id')
        //             ->havingRaw('soTiet > 4 ')
        //             ->get();
        // }
    }

    public function ChonDiaDiem($buoi, $ngay_id)
    {
        //chọn những địa điểm tại thời điểm đó trống
        if($buoi == 'S') $tiet = [1,5];
        if($buoi == 'C') $tiet = [6,10];
        //return $buoi;

        $diadiemTonTai = DB::table('hoidongluanvan')
                            ->where('ngay_id',$ngay_id)
                            ->whereIn('gio_id',$tiet)
                            ->groupBy('diadiem_id')
                            ->pluck('diadiem_id');
        //return $diadiemTonTai;

        $diadiem = LichBaoVe::where('ngay_id',$ngay_id)
                            ->whereNotIn('diadiem_id',$diadiemTonTai)
                            ->groupBy('diadiem_id')
                            ->get(['diadiem_id']);
        return $diadiem;
    }

    protected function TimHoiDong($LuanvanId)
    {
        $luanvan = luanvan::where('id',$LuanvanId)->first();
        
        if(isset($luanvan)){
            return $luanvan->hoidong()->get()->pluck('id')->toArray();
        }else{
            return [];
        }
        
    }

    protected function CanBoBan($ngay_id, $buoi)
    {
        $buoi == "S" ? $gio_id = [1,5] : $gio_id = [6,10];

        return DB::table('hoidongluanvan')
                    ->where('ngay_id',$ngay_id)
                    ->whereBetween('gio_id',$gio_id)
                    ->groupBy('canbo_id')
                    ->pluck('canbo_id')->toArray();
    }

    protected function TimLuanVan($hoidong, $valCheck, $canboBan)
    {
        $dsLuanvan = DB::table('hoidongluanvan')
                    //->selectRaw('hoidongluanvan.luanvan_id')
                    ->orderBy('hoidongluanvan.canbo_id')
                    ->whereIn('canbo_id', $hoidong)
                    ->whereNotIn('canbo_id',$canboBan) //các cán bộ bận
                    ->groupBy('hoidongluanvan.luanvan_id')
                    ->havingRaw('count(hoidongluanvan.luanvan_id) = '.$valCheck)
                    ->pluck('luanvan_id')->toArray();

        return $dsLuanvan;
    }

    protected function CheckKhaNang($hoidong, $dsGoiY, $soluongCanThem)
    {
        $arrLV = DB::table('hoidongluanvan')
                    //->selectRaw('hoidongluanvan.luanvan_id')
                    ->whereIn('hoidongluanvan.canbo_id', $hoidong)
                    ->orderBy('hoidongluanvan.canbo_id')
                    ->groupBy('hoidongluanvan.luanvan_id')
                    ->havingRaw('count(hoidongluanvan.luanvan_id) = 3')
                    ->whereNotIn('luanvan_id',$dsGoiY)
                    ->limit(5)
                    ->pluck('luanvan_id')->toArray();

        if(count($arrLV) > $soluongCanThem){
            return [];
        }else{
            return $arrLV;
        }
    }

    public function SelectHoiDong(Request $request)
    {
        $canboBan = $this->CanBoBan($request->ngay_id, $request->buoi);

        $luanvan = $request->luanvan_id;
        $hoidong = $this->TimHoiDong($luanvan);
        $dsLuanvan = $this->TimLuanVan($hoidong,3,[]);
        //return $dsLuanvan;
        $dsGoiY = [];
        $dsGoiY = array_merge($dsGoiY,$dsLuanvan);

        if( count($dsGoiY) >= 5 )
        {
            array_slice($dsGoiY,0,5); // dung
        }
        else
        {
            $dsLuanvan = $this->TimLuanVan($hoidong,2,$canboBan);
            foreach ($dsLuanvan as $luanvanId)
            {
                $hoidong = $this->TimHoiDong($luanvanId);
                if(count($hoidong) == 3)
                {
                    $soluongCanThem = 5 - count($dsGoiY);
                    $check = $this->CheckKhaNang($hoidong, $dsGoiY, $soluongCanThem);
                    if( count($check) !== 0 )
                    {
                        $dsGoiY = array_merge($dsGoiY,$check);
                        $dsGoiY = array_unique($dsGoiY);
                    }
                }
                if (count($dsGoiY) == 5) break;
            }

        }
        $request->buoi == 'S' ? $gio_id = 0 : $gio_id = 5;
        foreach ($dsGoiY as $luanvanId) {
            DB::table('hoidongluanvan')
                ->where( 'luanvan_id', $luanvanId )
                ->update([
                    'gio_id'  => ++$gio_id,
                    'ngay_id' => $request->ngay_id,
                    'diadiem_id' => $request->diadiem_id
                ]);
        }
        return "Thêm lịch thành công";
        
    }


}
