<?php
    require_once(__DIR__."/../PHP/counter.php");
    class myPage{
        private $Title = "";
        private $Author = "Michał Budnik";
        private $Desc = "";
        private $projectPath = "";

        function __construct(){
            $this->projectPath = realpath(__DIR__."/..");
        }

        public function SetDescription($arg = "") {
            $this->Desc = $arg;
        }
        public function SetTitle($arg = "") {
            $this->Title = $arg;
        }
        public function SetAuthor($arg = "") {
            $this->Author = $arg;
        }

        public function Begin(){
            $lines = file_get_contents($this->projectPath."\HTMLElements\begin.txt");
            $lines = str_replace("%desc%", $this->Desc, $lines);
            $lines = str_replace("%title%", $this->Title, $lines);
            $lines = str_replace("%author%", $this->Author, $lines);
            $lines = str_replace("%mainFolder%", basename($this->projectPath), $lines);
            return $lines;
        } 

        public function Header(){
            $counter = counter(__DIR__."/../PHP/counter.txt");
            $lines = file_get_contents($this->projectPath."\HTMLElements\header.txt");
            $lines = str_replace("%cnt%", $counter, $lines);
            $lines = str_replace("%mainFolder%", basename($this->projectPath), $lines);
            return $lines;
        }

        public function mainMenu($site = ""){
            $lines = file_get_contents($this->projectPath."\HTMLElements\mainMenu.txt");
            $lines = str_replace("%activeMain%", (($site == "main") ? ' class="active"' : ""), $lines);
            $lines = str_replace("%activeS1%", (($site == "semestr1") ? ' class="active"' : ""), $lines);
            $lines = str_replace("%activeS2%", (($site == "semestr2") ? ' class="active"' : ""), $lines);
            $lines = str_replace("%activeS3%", (($site == "semestr3") ? ' class="active"' : ""), $lines);
            $lines = str_replace("%activeComm%", (($site == "comments") ? ' class="active"' : ""), $lines);
            $lines = str_replace("%mainFolder%", basename($this->projectPath), $lines);
            return $lines;
        }

        public function createDiv3_6($head = "", $body = ""){
            $lines = file_get_contents($this->projectPath."\HTMLElements\div3_6.txt");
            $lines = str_replace("%head%", $head, $lines);
            $lines = str_replace("%body%", $body, $lines);
            return $lines;
        }

        public function createDiv4_6($head = "", $body = "", $formula = ""){
            $lines = file_get_contents($this->projectPath."\HTMLElements\div4_6.txt");
            $lines = str_replace("%head%", $head, $lines);
            $lines = str_replace("%body%", $body, $lines);
            $lines = str_replace("%formula%", (($formula=="") ? "" : "<img src=\"http://latex.codecogs.com/svg.latex?".$formula."\" border=\"0\"/>"), $lines);
            return $lines;
        }

        public function createCommentsDiv($comments){
            $lines = file_get_contents($this->projectPath."\HTMLElements\commentsDiv.txt");
            $lines = str_replace("%comments%", $comments, $lines);
            return $lines;
        }

        public function commentsMenu($site = ""){
            $lines = file_get_contents($this->projectPath."\HTMLElements\commentsMenu.txt");
            $lines = str_replace("%activeComm%", (($site == "comments.php") ? ' class="active"' : ""), $lines);
            $lines = str_replace("%activeAdd%", (($site == "comment.php") ? ' class="active"' : ""), $lines);
            $lines = str_replace("%mainFolder%", basename($this->projectPath), $lines);
            return $lines;
        }

        public function createCommentDiv(){
            $lines = file_get_contents($this->projectPath."\HTMLElements\commentDiv.txt");
            return $lines;
        }

        public function sideMenu($dirname = "", $site = ""){
            $siteDict = [
                "al.php" => "Algebra Liniowa",
                "am.php" => "Analiza Matematyczna",
                "lo.php" => "Logika Obliczeniowa",
                "md.php" => "Matematyka Dyskretna",
                "ni.php" => "Narzędzia Informatyki",
                "pp.php" => "Podstawy Programowania",
                "wdi.php" => "Wstęp do Informatyki",
                "wf.php" => "Wychowanie Fizyczne",
                "aaik.php" => "Algebra Abstrakcyjna i Kodowanie",
                "am2.php" => "Analiza Matematyczna 2",
                "kp.php" => "Kurs Programowania",
                "md2.php" => "Matematyka Dyskretna 2",
                "ppi.php" => "Problemy Prawne Informatyki",
                "akiso.php" => "Architektura Komputerów i Systemy Operacyjne",
                "bdizi.php" => "Bazy Danych i Zarządzanie Informacją",
                "mpis.php" => "Metody Probabilistyczne i Statystyka",
                "tp.php" => "Technologia Programowania"
            ];
            $lines = file_get_contents($this->projectPath."\HTMLElements\sideMenu.txt");
            $temp = "";
            $dir = new DirectoryIterator($dirname);
            foreach ($dir as $fileinfo) {
                if ($fileinfo != "semestr1.php" && $fileinfo != "semestr2.php" && $fileinfo != "semestr3.php"
                        && substr($fileinfo, strlen($fileinfo) - 4) == ".php"){
                    
                    $temp .= "\t\t\t\t\t<a href=\"$fileinfo\"".(($fileinfo == $site) ? ' class="active"' : "").
                        ">".$siteDict[(string) $fileinfo]."</a>\n";
                }
            }
            $lines = str_replace("%menu%", $temp, $lines);
            return $lines;
        }

        public function Footer(){
            $lines = file_get_contents($this->projectPath."\HTMLElements/footer.txt");
            return $lines;
        }

        public function End(){
            $lines = file_get_contents($this->projectPath."\HTMLElements/end.txt");
            $lines = str_replace("%projectFolder%", basename($this->projectPath), $lines);
            return $lines;
        }
    }
?>
