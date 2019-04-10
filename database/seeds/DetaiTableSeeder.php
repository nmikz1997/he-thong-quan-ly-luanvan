<?php

use Illuminate\Database\Seeder;

class DetaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$lastNK = 4;
    	$mota = 'Công ty Điện lực Thành phố Hồ Chí Minh, là một công ty lớn trực thuộc Tổng Công ty Điện lực Việt Nam hiện có khoảng 700.000 khách hàng (điện kế) phục vụ phân phối và kinh doanh điện năng cho toàn bộ khu vực Thành phố Hồ Chí Minh. Với một số lượng khách hàng lớn sử dụng điện năng cho nhiều mục đích khác nhau, đồng thời bên cạnh đó còn có những tiêu thức kinh doanh đặc biệt để thống kê, phân tích hệ thống kinh doanh nhằm đánh giá hiệu quả mang lại theo chiều hướng có lợi nhất cho ngành Điện nói riêng và cho sự phát triển của toàn xã hội nói chung, đòi hỏi ngành Điện phải có một hệ thống quản lý quy cũ, chặt chẽ và thống nhất. Hiểu rõ nhiệm vụ quan trọng của công tác kinh doanh điện năng trong đó xây dựng một Mô hình quản trị Hệ thống cơ sở dữ liệu hóa đơn tiền điện đồ sộ về mặt thông tin là một việc làm rất cần thiết. Mô hình quản lý này chặt chẽ, thống nhất, tuân thủ các nguyên tắc chuẩn mực của một hệ cơ sở dữ liệu sẽ có ý nghĩa rất lớn cho công tác quản lý kinh doanh điện năng';
        DB::table('detai')->insert([
        	[
        		'ten' => 'Đề tài quản lý A',
        		'canbo_id' => '00001',
        		'mota' => $mota,
        		'soluongsv' => 1,
        		'nienkhoa_id' => $lastNK
        	],
        	[
        		'ten' => 'Đề tài quản lý B',
        		'canbo_id' => '00001',
        		'mota' => $mota,
        		'soluongsv' => 2,
        		'nienkhoa_id' => $lastNK
        	],
        	[
        		'ten' => 'Đề tài Cloud',
        		'canbo_id' => '00001',
        		'mota' => $mota,
        		'soluongsv' => 1,
        		'nienkhoa_id' => $lastNK
        	],
        	[
        		'ten' => 'Đề tài IOT A',
        		'canbo_id' => '00003',
        		'mota' => $mota,
        		'soluongsv' => 2,
        		'nienkhoa_id' => $lastNK
        	],
        	[
        		'ten' => 'Đề tài BigData A',
        		'canbo_id' => '00002',
        		'mota' => $mota,
        		'soluongsv' => 1,
        		'nienkhoa_id' => $lastNK
        	],
        	[
        		'ten' => 'Đề tài BigData A',
        		'canbo_id' => '00002',
        		'mota' => $mota,
        		'soluongsv' => 2,
        		'nienkhoa_id' => $lastNK
        	]
        ]);
    }
}
