<?php

class Tutor extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));
        $this->load->model('comment_model');
        $this->load->model('courses_model');
    }

    function index($status = '2', $khoa_hoc_da_chon = '0', $type = '0', $start_date = '0', $end_date = '0') {
        //$this->lib_mod->load_all('student', '', array(), $per_page, $this->uri->segment(3), array('id'=>'desc'));
        $user_id = $this->session->userdata('user_id');
        if (!isset($user_id))
            die;
        // excel 3073
        // chuyenbka@gmail.com  12345678
        //hoa don chung tu 4909

        if ($this->input->get('status')) {
            $status = $this->input->get('status');
            $khoa_hoc_da_chon = $this->input->get('khoa_hoc_da_chon');
        }

        if ($this->input->get('start_date')) {
            $start_date = strtotime($this->input->get('start_date'));
        }

        if ($this->input->get('end_date')) {
            $end_date = strtotime($this->input->get('end_date'));
        }

        if ($this->input->get('type')) {
            $type = $this->input->get('type');
        }

        $ngay_hien_tai = getdate()[0];

        if (($end_date < $start_date) && $end_date !== '0') {
            echo ' <script>alert("Ngày bắt đầu không được lớn hơn ngày kết thúc !!!!")</script>';
            echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
            die;
        }
        if ($start_date !== 0 && $end_date == '0') {
            $dk_ngay1 = array('createdate >' => $start_date, 'createdate <' => $ngay_hien_tai);
            $dk_ngay2 = 'AND createdate >= ' . $start_date . ' AND createdate <= ' . $ngay_hien_tai;
        } elseif ($start_date == '0' && $end_date !== 0) {
            $dk_ngay1 = array('createdate >' => 0, 'createdate <' => $end_date);
            $dk_ngay2 = 'AND createdate >= 0 AND createdate <= ' . $end_date;
        } elseif ($start_date !== 0 && $end_date !== 0) {
            $dk_ngay1 = array('createdate >' => $start_date, 'createdate <' => $end_date);
            $dk_ngay2 = 'AND createdate >= ' . $start_date . ' AND createdate <= ' . $end_date;
        } else {
            $dk_ngay1 = array('createdate >' => 0, 'createdate <' => $ngay_hien_tai);
            $dk_ngay2 = '';
        }


        if ($type == '0') {
            $loai1 = array();
            $loai2 = '';
        } else {
            $loai1 = array('type' => $type);
            $loai2 = 'AND cmt.`type` = ' . $type;
        }


        $mycourses1 = $this->lib_mod->load_all('courses', '', array('status' => 1), '', '', '', '');
        foreach ($mycourses1 as $value) {
            $mycourses[] = $value['id'];
        }


        if (empty($khoa_hoc_da_chon) || $khoa_hoc_da_chon == '0') {
            $khoa_hoc_ne = array('courses_id' => $mycourses);
            $khoa_hoc_nua_ne = '';
        } else {
            $khoa_hoc_ne = array('courses_id' => $khoa_hoc_da_chon);
            $khoa_hoc_nua_ne = ' cmt.`courses_id` = ' . $khoa_hoc_da_chon . ' AND ';
        }
        $data = $this->data;
        foreach ($mycourses as $value) {
            $data['courses_tutor'][] = array('id' => $value, 'name' => $this->get_course_name($value));
        }


        $data['courses'] = $this->lib_mod->load_all('courses', '', array('status' => 1), '', '', '');
        $data['student'] = $this->lib_mod->load_all('student', '', array('id' => $user_id), '', '', '');

        if ($status == 2) {
            $query1 = 'select * from `tbl_comment` as cmt where ' . $khoa_hoc_nua_ne . ' cmt.`id` not in (select distinct cmt2.`parent` from `tbl_comment` as cmt2) '
                    . 'and cmt.`student_id`!= 3073 and cmt.`student_id` != 4909 ' . $dk_ngay2 . $loai2 . ' order by cmt.`createdate` DESC ';
            $query = $this->db->query($query1);
            $data['comments'] = $query->result_array();
        } elseif ($status == 1) {
            $data['comments'] = $this->lib_mod->load_all_where_in('comment', '', array_merge(array('parent' => ''), $dk_ngay1, $loai1), $khoa_hoc_ne, '', '', array('createdate' => 'desc'));
        }

        if (empty($status) && empty($khoa_hoc_da_chon)) {
            $config['base_url'] = site_url('tutor/index/');
            $config['uri_segment'] = 3;
        } else {
            $config['base_url'] = site_url('tutor/index/' . $status . '/' . $khoa_hoc_da_chon . '/' . $type . '/' . $start_date . '/' . $end_date);
            $config['uri_segment'] = 8;
        }
        $data['tong_cmt'] = count($data['comments']);
        $config['per_page'] = 20;
        $config['total_rows'] = $data['tong_cmt'];

        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();


        if ($status == 2) {
            if (empty($this->uri->segment(8))) {
                $off = 0;
            } else {
                $off = $this->uri->segment(8);
            }

            $query = 'select * from `tbl_comment` as cmt where ' . $khoa_hoc_nua_ne . ' cmt.`id` not in (select distinct cmt2.`parent` from `tbl_comment` as cmt2) '
                    . 'and cmt.`student_id`!= 3073 and cmt.`student_id` != 4909 ' . $dk_ngay2 . $loai2 . ' order by cmt.`id` DESC LIMIT 20 OFFSET ' . $off;
            $query = $this->db->query($query);
            $data['comment'] = $query->result_array();
        } elseif ($status == 1) {
            $data['comment'] = $this->lib_mod->load_all_where_in('comment', '', array_merge(array('parent' => ''), $dk_ngay1, $loai1), $khoa_hoc_ne, 20, $this->uri->segment(8), array('id' => 'desc'));
        }

        $this->session->set_tempdata('curr_segment', $this->uri->segment(3), 1800);
        $data['content'] = 'tutor/index';
        $data['title'] = "câu hỏi học viên - lakita";
        $this->load->view('template', $data);
    }

    function reload_comment() {
        $user_id = $this->session->userdata('user_id');
        if (!isset($user_id))
            die;
        // excel 3073
        //hoa don chung tu 4909
        $mycourses = $this->input->post('courses_id');

        $curr_segment = $this->session->tempdata('curr_segment');
        if (isset($curr_segment))
            $current_segment = $curr_segment;
        else
            $current_segment = 0;

        $data['comment'] = $this->lib_mod->load_all_where_in('comment', '', array('parent' => ''), array('courses_id' => $mycourses), 20, $current_segment, array('id' => 'desc'));
        $this->load->view('tutor/load_cmt2', $data);
    }

    function cmt() {
        $user_id = $this->session->userdata('user_id');
        if (!isset($user_id))
            die;
        $data = $this->data;
        $data['student'] = $this->lib_mod->load_all('student', '', array('id' => $user_id), '', '', '');
        $this->db->select("*, count(*)");
        $this->db->where_in('courses_id', [37, 10, 41, 65, 67, 39, 16, 69]);
        $this->db->where('parent', 0);
        $this->db->group_by('student_id');
        $this->db->order_by('count(*)', 'desc');
        $this->db->order_by('createdate', 'desc');
        $data['student_ids'] = $this->db->get("comment")->result_array();
//        echo '<pre>';
//        print_r($data['student_ids']);die;
        $data['content'] = 'tutor/cmt';
        $this->load->view('template', $data);
    }

    function cmte100() {
        $user_id = $this->session->userdata('user_id');
        if (!isset($user_id))
            die;
        $data = $this->data;
        $data['comments'] = $this->lib_mod->load_all_where_in('comment', '', array('parent' => ''), array('courses_id' => [37, 10]), '', '', array('createdate' => 'desc'));
        $data['student'] = $this->lib_mod->load_all('student', '', array('id' => $user_id), '', '', '');
        $config['base_url'] = site_url('tutor/index/');
        $config['per_page'] = 20;
        $config['total_rows'] = count($data['comments']);
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();
        $data['comment'] = $this->lib_mod->load_all_where_in('comment', '', array('parent' => ''), array('courses_id' => [37, 10]), 20, $this->uri->segment(3), array('id' => 'desc'));
        $this->session->set_tempdata('curr_segment', $this->uri->segment(3), 1800);
        $data['content'] = 'tutor/index';
        $this->load->view('template', $data);
    }

    function repair_comment() {

        $cmtid_repair = htmlspecialchars(trim($this->input->post('cmtid_repair')));
        $content = str_replace('<script>', '', (nl2br(trim($this->input->post('content')))));

        if (isset($content)) {
            $this->lib_mod->repair_cmt('comment', array('id' => $cmtid_repair), array('content' => $content));
            echo 1;
        }
        if ($cmtid_repair == '') {
            echo 3;
            die;
        }
    }

    function del_comment() {
        $cmtid = $this->input->get('cmtid');
        $duong_dan = $this->input->get('url');
        $this->lib_mod->del_cmt($cmtid);
        header('Location:' . $duong_dan);
    }

    function update_type() {
        $id_cmt = $this->input->post('id_cmt');
        $type = $this->input->post('type');

        $where = array('id' => $id_cmt);
        $data = array('type' => $type);
        $this->comment_model->update($where, $data);
        echo 1;
    }
    
    function update_hide() {
        $id_cmt = $this->input->post('id_cmt');
        $hide = $this->input->post('hide');

        $where = array('id' => $id_cmt);
        $data = array('is_hide' => $hide);
        $this->comment_model->update($where, $data);
        echo 1;
    }

function index2() {

        $user_id = $this->session->userdata('user_id');
        if (!isset($user_id)) {
            die;
        }
        $this->load->model('student_model');
        $this->load->model('speaker_model');
        $this->load->model('courses_model');

        $data = $this->data;
        $data['student'] = $this->student_model->load_all(array('where' => array('id' => $user_id)));
        
        //$tutor = array('2626', '5844', '4909', '3073', '7252', '7346', '7671','8844', '9225', '9287','10181','11135','12147','11451');
        //  var_dump($input);die;

        if ($data['student'][0]['is_tutor'] != 1) {
            die;
        }
       
        $get = $this->input->get();
        //   var_dump($get);die;
        $status = (!empty($this->input->get('status'))) ? $get['status'] : '1';
        $course = (!empty($this->input->get('course'))) ? $get['course'] : '0';
        $start_date = (!empty($this->input->get('start_date'))) ? strtotime($get['start_date']) : '0';
        $end_date = (!empty($this->input->get('end_date'))) ? strtotime($get['end_date']) : '0';
        $type = (!empty($this->input->get('type'))) ? $get['type'] : '0';


        $input = array();
        $input['select'] = 'id';
        $input['where']['email'] = $data['student'][0]['email'];

        $id_speaker = $this->speaker_model->load_all($input);

        if (empty($id_speaker)) {
            $input_course = array();
            $input_course['where'] = array('status' => 1);
        } else {
            $input_course = array();
            $input_course['where']['status'] = 1;
            $input_course['like']['speaker_id'] = $id_speaker[0]['id'];
        }
        $mycourses1 = $this->courses_model->load_all($input_course);
        foreach ($mycourses1 as $value) {
            $mycourses[] = $value['id'];
        }
        $input = array();
        $input['where'] = array('parent' => '0');
        $input['order'] = array('createdate' => 'DESC');



        if ($course == '0') {
            $input['where_in'] = array('courses_id' => $mycourses);
        } else {
            $input['where_in'] = array('courses_id' => $course);
        }

        if (($end_date < $start_date) && $end_date !== '0') {
            echo ' <script>alert("Ngày bắt đầu không được lớn hơn ngày kết thúc !!!!")</script>';
            echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
            die;
        }
        if ($start_date !== 0 && $end_date == '0') {
            $input['where']['createdate >'] = $start_date;
            $input['where']['createdate <'] = getdate()[0];
        } elseif ($start_date == '0' && $end_date !== 0) {
            $input['where']['createdate >'] = 0;
            $input['where']['createdate <'] = $end_date;
        } elseif ($start_date !== 0 && $end_date !== 0) {
            $input['where']['createdate >'] = $start_date;
            $input['where']['createdate <'] = $end_date;
        } else {
            $input['where']['createdate >'] = 0;
            $input['where']['createdate <'] = getdate()[0];
        }


        if ($type != '0') {
            $input['where']['type'] = $type;
        }

        //đây là danh sách tất cả cmt
        $comments_all = $this->comment_model->load_all($input);

        if (empty($status) && empty($khoa_hoc_da_chon)) {
            $config['base_url'] = site_url('tutor/index2/');
            $config['uri_segment'] = 3;
        } else {
            $config['base_url'] = site_url('tutor/index2/' . $status . '/' . $course . '/' . $type . '/' . $start_date . '/' . $end_date);
            $config['uri_segment'] = 8;
        }

        if (empty($this->uri->segment(8))) {
            $off = '0';
        } else {
            $off = $this->uri->segment(8);
        }

        if ($status == '2') {
            foreach ($comments_all as $key => $value) {
                if (!$this->check_rep($value['id'])) {
                    //đây là danh sách cmt chưa trả lời
                    $comments_no_rep[] = $value['id'];
                }
            }
            if (empty($comments_no_rep)) {
                $input['where_in'] = array('id' => 0);
            } else {
                $input['where_in'] = array('id' => $comments_no_rep);
            }
            $data['tong_cmt'] = count($this->comment_model->load_all($input));
            $input['limit'] = array('20', $off);
            $comments = $this->comment_model->load_all($input);
            foreach ($comments as $k_comments => $v_comments) {
                if ($this->check_rep($v_comments['id'])) {
                    $comments[$k_comments]['rep'] = 1;
                } else {
                    $comments[$k_comments]['rep'] = 0;
                }
            }
            $data['comment'] = $comments;
        } else {
            $data['tong_cmt'] = count($this->comment_model->load_all($input));
            $input['limit'] = array('20', $off);
            $comments = $this->comment_model->load_all($input);
            foreach ($comments as $k_comments => $v_comments) {
                if ($this->check_rep($v_comments['id'])) {
                    $comments[$k_comments]['rep'] = 1;
                } else {
                    $comments[$k_comments]['rep'] = 0;
                }
            }
            $data['comment'] = $comments;
        }

        $config['per_page'] = 20;
        $config['total_rows'] = $data['tong_cmt'];
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();

        foreach ($mycourses as $value) {
            $data['courses_tutor'][] = array('id' => $value, 'name' => $this->get_course_name($value));
        }

        $this->session->set_tempdata('curr_segment', $this->uri->segment(3), 1800);
        $data['courses'] = $mycourses1;
        $data['content'] = 'tutor/index';
        $data['title'] = "câu hỏi học viên - lakita";
        $this->load->view('template', $data);
    }
    
    function check_rep($id_cmt) {

        $input_no_rep['where'] = array('parent' => $id_cmt);
        $input_no_rep['order'] = array('createdate' => 'DESC');
        $comments_no_rep = $this->comment_model->load_all($input_no_rep);
        $check = array_shift($comments_no_rep);

        $list_tutor = array(4909, 3073, 3294, 2668, 7252, 7346, 7671,8844, 9225, 9287,10181,11135,12147,11451,11348);

        if (in_array($check['student_id'], $list_tutor)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_course_name($id) {
        $name = '';
        $input['where'] = array('id' => $id);
        $course = $this->courses_model->load_all($input);
        if (!empty($course))
            $name = $course[0]['name'];
        return $name;
    }

    function report_comment() {
        $user_id = $this->session->userdata('user_id');
        $manager = array('2626', '5844', '4909', '3073');
        if (!isset($user_id) && !in_array($user_id, $manager))
            die;
        $data = $this->data;
        $data['courses'] = $this->lib_mod->load_all('courses', '', array('status' => 1), '', '', '');
        $data['student'] = $this->lib_mod->load_all('student', '', array('id' => $user_id), '', '', '');
        $data['content'] = 'tutor/report_comment';
        $data['title'] = "báo cáo comment";
        $this->load->view('template', $data);
    }

    function result_report_comment() {


        $user_id = $this->session->userdata('user_id');
        $manager = array('2626', '5844', '4909', '3073');
        if (!isset($user_id) && !in_array($user_id, $manager))
            die;
        $data = $this->data;
        $data['courses'] = $this->lib_mod->load_all('courses', '', array('status' => 1), '', '', '');

        $post = $this->input->post();

        



        $start_date = $post['start_date'];
        $end_date = $post['end_date'];


        if ($start_date !== '' && $end_date == '') {
            $input['where']['createdate >'] = strtotime($start_date);
            $input['where']['createdate <'] = time();
        } elseif ($start_date == '' && $end_date !== '') {
            $input['where']['createdate >'] = '0';
            $input['where']['createdate <'] = strtotime($end_date);
        } elseif ($start_date !== '' && $end_date !== '') {
            $input['where']['createdate >'] = strtotime($start_date);
            $input['where']['createdate <'] = strtotime($end_date);
        } else {
            $input['where']['createdate >'] = '0';
            $input['where']['createdate <'] = time();
        }
        $input['where']['parent'] = '0';


        $input_course['where'] = array('status' => 1);
        $mycourses1 = $this->courses_model->load_all($input_course);

        if (isset($post['courseID'])) {
            $courses = $post['courseID'];
        } else {
            $courses = '';
        }
        
        if ($courses[0] == 0 || $courses == '') {
            $courses = array();
            foreach ($mycourses1 as $value) {
                $courses[] = $value['id'];
            }
        }
        
        
        
        if (isset($post['type'])) {
            $type = $post['type'];
        } else {
            $type = '';
        }
        
        if ($type[0] == 0 || $type == '') {
            $type = array('0' => '2', '1' => '5', '2' => '3', '3' => '4', '4' => '1');
        }

        foreach ($mycourses1 as $value) {
            $mycourses[] = $value['id'];
        }
        $input_all['where']['parent'] = '0';
        $input_all['where']['createdate >'] = $input['where']['createdate >'];
        $input_all['where']['createdate <'] = $input['where']['createdate <'];
        $input_all['where_in'] = array('courses_id' => $mycourses);
        $data['num_all_comments'] = count($this->comment_model->load_all($input_all));

        $input['where']['courses_id'] = 0;




        $comments = array();
        foreach ($courses as $key => $value) {
            if ($value != 0) {
                $course = $this->courses_model->load_all(array('where' => array('id' => $value)));
                $comments[$value]['course_code'] = $course[0]['course_code'];
                $comments[$value]['course_name'] = $course[0]['name'];
                $input['where']['courses_id'] = $value;

                $comments[$value]['num_course_comments'] = $this->_get_num_course_comment($value);
                foreach ($type as $v_type) {
                    $input['where']['type'] = $v_type;
                    $comments_list_by_type = $this->comment_model->load_all($input);
                    $comments[$value]['type']['type_' . $v_type] = count($comments_list_by_type);
                    if ($comments[$value]['type']['type_' . $v_type] != 0) {
                        $comments_comments_list_by_type_no_rep = array();
                        $comments_comments_list_by_type_reped = array();
                        foreach ($comments_list_by_type as $key => $value1) {
                            if (!$this->check_rep($value1['id'])) {
                                //đây là danh sách cmt chưa trả lời
                                $comments_comments_list_by_type_no_rep[] = $value1['id'];
                            } else {
                                $comments_comments_list_by_type_reped[] = $value1['id'];
                            }
                            if (isset($comments_comments_list_by_type_no_rep)) {
                                $comments[$value]['type']['type_' . $v_type . '_no_rep'] = count($comments_comments_list_by_type_no_rep);
                            } else {
                                $comments[$value]['type']['type_' . $v_type . '_no_rep'] = '0';
                            }
                            if (isset($comments_comments_list_by_type_reped)) {
                                $comments[$value]['type']['type_' . $v_type . '_reped'] = count($comments_comments_list_by_type_reped);
                            } else {
                                $comments[$value]['type']['type_' . $v_type . '_reped'] = '0';
                            }
                        }
                    } else {
                        $comments[$value]['type']['type_' . $v_type . '_no_rep'] = '0';
                        $comments[$value]['type']['type_' . $v_type . '_reped'] = '0';
                    }
                }
            }
        }

        $data['comments'] = $comments;

//        echo '<pre>';
//        print_r($comments);
//        die;

        $data['student'] = $this->lib_mod->load_all('student', '', array('id' => $user_id), '', '', '');
        $data['content'] = 'tutor/report_comment';
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['title'] = "báo cáo trợ giảng";
        $this->load->view('template', $data);
    }

    function _get_num_course_comment($course_id) {
        $this->load->model('comment_model');
        $input['where'] = array('courses_id' => $course_id, 'parent' => '0');
        $num = count($this->comment_model->load_all($input));
        return $num;
    }

}
