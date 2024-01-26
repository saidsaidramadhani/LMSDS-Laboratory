<?php
namespace App\Libraries;

class Department_menu
{
    public function menu()
    {
		$mymenu = session()->get('USER_MENU');
        $leftmenu_save = '<li> <a href="javascript:void(0);" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Settings<span class="fa fa-fw"></span></a>';
        $leftmenu_save .= '<ul class="nav nav-second-level">';
        $leftmenu_save .= '<li> <a href="' . site_url('systems') . '" class="waves-effect"> <span class="hide-menu">System Settings</span></a> </li>';
        $leftmenu_save .= '<li> <a href="' . site_url('Course_off') . '" class="waves-effect"> <span class="hide-menu">Courses Offered</span></a> </li>';
        $leftmenu_save .= '<li> <a href="' . site_url('Semister_unit') . '" class="waves-effect"> <span class="hide-menu">Semester Credits</span></a> </li>';
        $leftmenu_save .= '<li> <a href="' . site_url('Prog_courses') . '" class="waves-effect"> <span class="hide-menu">Programme Structure</span></a> </li>';
        $leftmenu_save .= '<li> <a href="' . site_url('Exam_reg') . '" class="waves-effect"> <span class="hide-menu">Exam Regulation</span></a> </li>';
        $leftmenu_save .= '<li> <a href="' . site_url('Course_all') . '" class="waves-effect"> <span class="hide-menu">Course Allocation</span></a> </li>';
        $leftmenu_save .= '</ul>';
        $leftmenu_save .= '</li>';
        $leftmenu_save .= '<li><a href="' . site_url('auth/logout') . '" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>';

        return $leftmenu_save;
    }
}

/*Menu file ends here */