<?php

class Helpers_paging {

    private $link;
    private $config;

    //* Construct ------------------------------------------------------------------------
    function __construct($config = '') {
        //Intial

        $this->config['page_total'] = (int) $config['page_total']; //Tong so ket qua
        if ($config['page_rows'] != '')
            $this->config['page_rows'] = (int) $config['page_rows']; //So hang tren 1 trang
        else
            $this->config['page_rows'] = 10;
        if (isset($config["page"]) && $config["page"] != '')
            $this->config['page'] = $config["page"];
        else
            $this->config['page'] = 'page';

        if (isset($this->config['slash']) && $this->config['slash'] != '')
            $this->config['slash'] = $config["slash"]; // ? or &
        else
            $this->config['slash'] = '&';

        if (isset($this->config['equal']) && $this->config['equal'] != '')
            $this->config['equal'] = $config["equal"]; // = or /
        else
            $this->config['equal'] = '=';

        $this->config["link"] = $config["link"];

        $this->config['page_current'] = $this->page_current(); // Page Current
        //Skin
        $this->config["show"]["begin"] = '<img alt="first"  src="Public/images/first.png">';
        $this->config["show"]["end"] = '<img  alt="end"  src="Public/images/end.png">';
        $this->config["show"]["next"] = '<img alt="next"  src="Public/images/next.png">';
        $this->config["show"]["previous"] = '<img  alt="previous"  src="Public/images/previous.png">';
        $this->config["show"]["space"] = " ";
        $this->config["show"]["noshow"] = " ... ";


        //Kiem tra xem co truyen bien thay doi Skin hay ko
        if (isset($config["show"]["begin"])) {
            $this->config["show"]["begin"] = $config["show"]["begin"];
        }
        if (isset($config["show"]["end"])) {
            $this->config["show"]["end"] = $config["show"]["end"];
        }
        if (isset($config["show"]["next"])) {
            $this->config["show"]["next"] = $config["show"]["next"];
        }
        if (isset($config["show"]["previous"])) {
            $this->config["show"]["previous"] = $config["show"]["previous"];
        }
        if (isset($config["show"]["space"])) {
            $this->config["show"]["space"] = $config["show"]["space"];
        }
        if (isset($config["show"]["noshow"])) {
            $this->config["show"]["noshow"] = $config["show"]["noshow"];
        }
    }

    //*** Construct ------------------------------------------------------------------------
    //* Page Current ------------------------------------------------------------------------
    private function page_current() {
        if (!isset($_REQUEST[$this->config['page']])) {
            return 1;
        } else {
            if ((int) $_REQUEST[$this->config['page']] <= 0)
                return 1;
            else
                return (int) $_REQUEST[$this->config['page']];
        }
    }

    //*** Page Current ------------------------------------------------------------------------
    //*** Create Limit
    //* Create Paging - Return string ---------------------------------------------------------
    public function create() {
        //Tinh tong se trang
        $page_end = ceil($this->config['page_total'] / $this->config['page_rows']);
        if ($page_end != 1 && $this->config['page_total'] != 0) {
            $paging["begin"] = "";
            if ($this->config['page_current'] != 1) {
                $paging["begin"] = "<span><a href='" . $this->config["link"] . "&page=1' >" . $this->config["show"]["begin"] . "</a></span> " . $this->config["show"]["space"];
                $paging["begin"] .= "<span><a href='" . $this->config["link"] . "&page=" . ($this->config['page_current'] - 1) . "' >" . $this->config["show"]["previous"] . "</a></span> " . $this->config["show"]["space"];
            }
            $paging["end"] = "";
            if ($this->config["page_current"] != $page_end) {
                $paging["end"] = "<span><a href='" . $this->config["link"] . "&page=" . ($this->config['page_current'] + 1) . "' >" . $this->config["show"]["next"] . "</a></span> " . $this->config["show"]["space"];
                $paging["end"] .= $this->config["show"]["space"] . "<span><a href='" . $this->config["link"] . $this->config["slash"] . $this->config["page"] . $this->config["equal"] . $page_end . "' >" . $this->config["show"]["end"] . "</a></span>";
            }
            //Lien ket truoc
            $paging["first_midded"] = "";
            if ($this->config["page_current"] > 1) {
                if ($this->config["page_current"] - 2 > 1) {
                    $paging["first_midded"] .= " " . $this->config["show"]["noshow"] . " ";
                }
                if ($this->config["page_current"] - 1 > 1) {
                    $paging["first_midded"] .= " <span><a class='number' href='" . $this->config["link"] . $this->config["slash"] . $this->config["page"] . $this->config["equal"] . ($this->config["page_current"] - 2) . "'>" . ($this->config["page_current"] - 2) . "</a></span> " . $this->config["show"]["space"];
                }
                $paging["first_midded"] .= " <span><a class='number' href='" . $this->config["link"] . $this->config["slash"] . $this->config["page"] . $this->config["equal"] . ($this->config["page_current"] - 1) . "'>" . ($this->config["page_current"] - 1) . "</a></span> " . $this->config["show"]["space"];
            }

            //Lien ket cac trang sau
            $paging["second_midded"] = "";
            if ($this->config["page_current"] < $page_end) {

                $paging["second_midded"] .= $this->config["show"]["space"] . " <span><a class='number' href='" . $this->config["link"] . $this->config["slash"] . $this->config["page"] . $this->config["equal"] . ($this->config["page_current"] + 1) . "'>" . ($this->config["page_current"] + 1) . "</a> </span>";
                if ($this->config["page_current"] + 1 < $page_end) {
                    $paging["second_midded"] .= $this->config["show"]["space"] . " <span><a class='number' href='" . $this->config["link"] . $this->config["slash"] . $this->config["page"] . $this->config["equal"] . ($this->config["page_current"] + 2) . "'>" . ($this->config["page_current"] + 2) . "</a> </span>";
                }
                if ($this->config["page_current"] + 2 < $page_end) {
                    $paging["second_midded"] .= " " . $this->config["show"]["noshow"] . " ";
                }
            }
            return $this->link = $paging["begin"] . $paging["first_midded"] . " <span id='current_page'><label>" . $this->config["page_current"] . "</label></span> " . $paging["second_midded"] . $paging["end"];
        } else {
            return "";
        }
    }

    public function create_rewrite($page_current) {

        //Tinh tong se trang
        $page_end = ceil($this->config['page_total'] / $this->config['page_rows']);
        if ($page_end != 1 && $this->config['page_total'] != 0) {
            $paging["begin"] = "";
            if ($page_current != 1) {
                $paging["begin"] = "<span><a href='" . $this->config["link"] . "/page-1.html' >" . $this->config["show"]["begin"] . "</a></span> " . $this->config["show"]["space"];
                $paging["begin"] .= "<span><a href='" . $this->config["link"] . "/page-" . ($page_current - 1) . ".html' >" . $this->config["show"]["previous"] . "</a></span> " . $this->config["show"]["space"];
            }
            $paging["end"] = "";
            if ($page_current != $page_end) {
                $paging["end"] = "<a class='page' href='" . $this->config["link"] . "/page-" . ($page_current + 1) . ".html' >" . $this->config["show"]["next"] . "</a>" . $this->config["show"]["space"];
                $paging["end"] .= $this->config["show"]["space"] . "<a class='page' href='" . $this->config["link"] . '/page-' . $page_end . ".html' >" . $this->config["show"]["end"] . "</a>";
            }
            //Lien ket truoc
            $paging["first_midded"] = "";
            if ($page_current > 1) {
                if ($page_current - 2 > 1) {
                    $paging["first_midded"] .= " " . $this->config["show"]["noshow"] . " ";
                }
                if ($page_current - 1 > 1) {
                    $paging["first_midded"] .= " <a class='page' href='" . $this->config["link"] . '/page-' . ($page_current - 2) . ".html'>" . ($page_current - 2) . "</a></span> " . $this->config["show"]["space"];
                }
                $paging["first_midded"] .= " <a class='page' href='" . $this->config["link"] . '/page-' . ($page_current - 1) . ".html'>" . ($page_current - 1) . "</a></span> " . $this->config["show"]["space"];
            }

            //Lien ket cac trang sau
            $paging["second_midded"] = "";
            if ($page_current < $page_end) {

                $paging["second_midded"] .= $this->config["show"]["space"] . " <a class='page' href='" . $this->config["link"] . '/page-' . ($page_current + 1) . ".html'>" . ($page_current + 1) . "</a> ";
                if ($page_current + 1 < $page_end) {
                    $paging["second_midded"] .= $this->config["show"]["space"] . " <a class='page' href='" . $this->config["link"] . '/page-' . ($page_current + 2) . ".html'>" . ($page_current + 2) . "</a> ";
                }
                if ($page_current + 2 < $page_end) {
                    $paging["second_midded"] .= " " . $this->config["show"]["noshow"] . " ";
                }
            }
            return $this->link = $paging["first_midded"] . " <span class='current'>" . $page_current . "</span> " . $paging["second_midded"];
        } else {
            return "";
        }
    }

    public function create_ajax() {
        $page_end = ceil($this->config['page_total'] / $this->config['page_rows']);
        if ($page_end != 1 && $this->config['page_total'] != 0) {
            $paging["begin"] = "";
            if ($this->config['page_current'] != 1) {
                $paging["begin"] = '<span><a href="javascript:' . $this->config["link"] . '1)" >' . $this->config["show"]["begin"] . '</a></span> ' . $this->config["show"]["space"];
                $paging["begin"] .= '<span><a href="javascript:' . $this->config["link"] . ($this->config['page_current'] - 1) . ')" >' . $this->config["show"]["previous"] . '</a></span> ' . $this->config["show"]["space"];
            }

            $paging["end"] = "";
            if ($this->config["page_current"] != $page_end) {
                $paging["end"] = '<span><a href="javascript:' . $this->config["link"] . ($this->config['page_current'] + 1) . ')" >' . $this->config["show"]["next"] . '</a></span> ' . $this->config["show"]["space"];
                $paging["end"] .= $this->config["show"]["space"] . '<span><a href="javascript:' . $this->config["link"] . $page_end . ')" >' . $this->config["show"]["end"] . '</a></span>';
            }

            $paging["first_midded"] = "";
            if ($this->config["page_current"] > 1) {
                if ($this->config["page_current"] - 2 > 1) {
                    $paging["first_midded"] .= " " . $this->config["show"]["noshow"] . " ";
                }
                if ($this->config["page_current"] - 1 > 1) {
                    $paging["first_midded"] .= ' <span><a class="number" href="javascript:' . $this->config["link"] . ($this->config["page_current"] - 2) . ')">' . ($this->config["page_current"] - 2) . '</a></span> ' . $this->config["show"]["space"];
                }
                $paging["first_midded"] .= ' <span><a class="number" href="javascript:' . $this->config["link"] . ($this->config["page_current"] - 1) . ')">' . ($this->config["page_current"] - 1) . '</a></span> ' . $this->config["show"]["space"];
            }

            $paging["second_midded"] = "";
            if ($this->config["page_current"] < $page_end) {

                $paging["second_midded"] .= $this->config["show"]["space"] . ' <span><a class="number" href="javascript:' . $this->config["link"] . ($this->config["page_current"] + 1) . ')">' . ($this->config["page_current"] + 1) . '</a> </span>';
                if ($this->config["page_current"] + 1 < $page_end) {
                    $paging["second_midded"] .= $this->config["show"]["space"] . ' <span><a class="number" href="javascript:' . $this->config["link"] . ($this->config["page_current"] + 2) . ')">' . ($this->config["page_current"] + 2) . '</a> </span>';
                }
                if ($this->config["page_current"] + 2 < $page_end) {
                    $paging["second_midded"] .= " " . $this->config["show"]["noshow"] . " ";
                }
            }

            return $this->link = $paging["begin"] . $paging["first_midded"] . ' <span id="current_page"><label>' . $this->config["page_current"] . '</label></span> ' . $paging["second_midded"] . $paging["end"];
        } else {
            return "";
        }
    }

}

/* Config Paging
  $config['page_total'] = 999;
  $config['page_rows'] = 10; //So hang tren 1 trang



  $config["page"] = "page";
  $config["slash"] = "?";   // ? or &
  $config["equal"] = "=";   // = or /
  $config["link"] = "http://localhost/ifrc/admin2/Libraries/paging.php";


  //Skin
  $config["show"]["begin"] = "Trang dau";

  $config["show"]["end"] = "Trang cuoi";


  $config["show"]["space"] = "-";
  $config["show"]["noshow"] = "...";

  $config["tag"]['name'] = "span"; //Ten tag - (div,span)
  $config["tag"]['attribute'] = "class='paging'"; //thuoc tinh - (class = 'paging')

  $config['href']['class'] = "class='number'";

  //*** Config Paging
  //$a = new Paging($config);
  //Xuat ra phan trang
  //echo $a->create();
  //Tao ra Limit
  //echo $a->page_limit();

 */
?>