<?php require_once __DIR__ . '/config.php'; ?><?php
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>李榮三教授個人履歷</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="styles.php" rel="stylesheet" type="text/css"/>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-block d-lg-none">李榮三教授</span>
                <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="https://i.ibb.co/4dMmDJv/899631.jpg" alt="899631" ></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">簡例</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#experience">空閒時間</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#education">個人經歷</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#skills">撰寫書籍</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#interests">撰寫論文</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#plan">參與計畫</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#awards">獲得獎項</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="enter.php" id="manage">後台管理系統</a>
                </ul>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- About-->
            <section class="resume-section" id="about">
                <div class="resume-section-content">
                    <h1 class="mb-0">
                        李榮三
                        <span class="text-primary">教授</span>
                    </h1>
                    <div class="subheading mb-2">
                        逢甲大學 資訊工程系 系主任
                    </div>
                    <div class="subheading mb-2">
                        分機: #3700 #3767
                        <a href="mailto:name@email.com">leejs@fcu.edu.tw</a>
                    </div>
                    <h3 class="mb-0">學歷</h3>
                    <p class="lead mb-1">中正大學 資訊工程學系 博士</p>
                    <p class="lead mb-1">中正大學 資訊工程學系 學士</p>
                    <h3 class="mb-0">專長</h3>
                    <p class="lead mb-1">無線通訊  Wireless Communications</p>
                    <p class="lead mb-1">資訊安全  Information Security</p>
                    <p class="lead mb-1">電子商務  E-Commerce</p>
                    <p class="lead mb-1">密碼學  Cryptography</p>
                    <p class="lead mb-1">數位影像處理  Image Processing</p>
                    <p class="lead mb-1">區塊鏈技術與應用  Blockchain technique and its application</p>
                    <!--div class="social-icons">
                        <a class="social-icon" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        <a class="social-icon" href="#!"><i class="fab fa-github"></i></a>
                        <a class="social-icon" href="#!"><i class="fab fa-twitter"></i></a>
                        <a class="social-icon" href="#!"><i class="fab fa-facebook-f"></i></a>
                    </div-->
                </div>
            </section>
            <hr class="m-0" />
            <!-- Experience-->
            <section class="resume-section" id="experience">
                <div class="resume-section-content">
                    <h2 class="mb-5">空閒時間</h2>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">課表</h3>
                            <table width = 800>
                                <?php
                                $sql = "SELECT * FROM TIME ";
                                $result = mysqli_query($link, $sql);
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row["Day"] . "</td>"; 
                                    echo "<td>" . $row["Class"] . "</td>";
                                    echo "<td>" . $row["Class_name"] . "</td>"; 
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                        <!--div class="flex-shrink-0"><span class="text-primary">March 2013 - Present</span></div-->
                    </div>
                    <!--div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">Web Developer</h3>
                            <div class="subheading mb-3">Intelitec Solutions</div>
                            <p>Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">December 2011 - March 2013</span></div>
                    </div-->
                    <!--div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">Junior Web Designer</h3>
                            <div class="subheading mb-3">Shout! Media Productions</div>
                            <p>Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence on cross-platform integration.</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">July 2010 - December 2011</span></div>
                    </div-->
                    <!--div class="d-flex flex-column flex-md-row justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">Web Design Intern</h3>
                            <div class="subheading mb-3">Shout! Media Productions</div>
                            <p>Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">September 2008 - June 2010</span></div>
                    </div-->
                </div>
            </section>
            <hr class="m-0" />
            <!-- Education-->
            <section class="resume-section" id="education">
                <div class="resume-section-content">
                    <h2 class="mb-5">個人經歷</h2>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">校內經歷</h3>
                            <!--div class="subheading mb-3">Bachelor of Science</div>
                            <div>Computer Science - Web Development Track</div>
                            <p>GPA: 3.23</p-->
                            <table width = 300>
                                <?php
                                $sql = "SELECT * FROM EXPERIENCE WHERE Type='0' ";
                                $result = mysqli_query($link, $sql);
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row["Department"] . "</td>"; 
                                    echo "<td>" . $row["Position"] . "</td>"; 
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                        <!--div class="flex-shrink-0"><span class="text-primary">August 2006 - May 2010</span></div-->
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">校外經歷</h3>
                            <!--div class="subheading mb-3">Technology Magnet Program</div>
                            <p>GPA: 3.56</p-->
                            <table width = 300>
                                <?php
                                $sql = "SELECT * FROM EXPERIENCE WHERE Type='1' ";
                                $result = mysqli_query($link, $sql);
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row["Department"] . "</td>"; 
                                    echo "<td>" . $row["Position"] . "</td>"; 
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                        <!--div class="flex-shrink-0"><span class="text-primary">August 2002 - May 2006</span></div-->
                    </div>
                </div>
            </section>
            <hr class="m-0" />
            <!-- Skills-->
            <section class="resume-section" id="skills">
                <div class="resume-section-content">
                    <h2 class="mb-5">撰寫書籍</h2>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">專書</h3>
                            <!--div class="subheading mb-3">Bachelor of Science</div>
                            <div>Computer Science - Web Development Track</div>
                            <p>GPA: 3.23</p-->
                            <table width = 800>
                                <?php
                                $sql = "SELECT * FROM BOOK WHERE Type='1' ";
                                $result = mysqli_query($link, $sql);
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row["Name"] . "</td>"; 
                                    echo "<td>" . $row["Press"] . "</td>"; 
                                    echo "<td>" . $row["Nation"] . "</td>"; 
                                    echo "<td>" . $row["Date"] . "</td>"; 
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">教材</h3>
                            <!--div class="subheading mb-3">Technology Magnet Program</div>
                            <p>GPA: 3.56</p-->
                            <table width = 800>
                                <?php
                                $sql = "SELECT * FROM BOOK WHERE Type='0' ";
                                $result = mysqli_query($link, $sql);
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row["Name"] . "</td>"; 
                                    echo "<td>" . $row["Press"] . "</td>"; 
                                    echo "<td>" . $row["Nation"] . "</td>"; 
                                    echo "<td>" . $row["Date"] . "</td>"; 
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                        <!--div class="flex-shrink-0"><span class="text-primary">August 2002 - May 2006</span></div-->
                    </div>
            </section>
            
            <hr class="m-0" />
            <!-- Interests-->
            <section class="resume-section" id="interests">
                <div class="resume-section-content">
                    <h2 class="mb-5">撰寫論文</h2>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">期刊論文</h3>
                            <!--div class="subheading mb-3">Bachelor of Science</div>
                            <div>Computer Science - Web Development Track</div>
                            <p>GPA: 3.23</p-->
                            <table width = 1000 >
                                <?php
                                $sql = "SELECT * FROM PAPER WHERE Type='2' ";
                                $result = mysqli_query($link, $sql);
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row["Teacher"] . "</td>";
                                    echo "<td>" . $row["Name"] . "</td>";  
                                    echo "<td>" . $row["Date"] . "</td>"; 
                                    echo "<td>" . $row["Page"] . "</td>";                                   
                                    echo "<td>" . $row["Num"] . "</td>";
                                    echo "<td>" . $row["Source"] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                        <!--div class="flex-shrink-0"><span class="text-primary">August 2006 - May 2010</span></div-->
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">會議論文</h3>
                            <table width = 1000 >
                                <?php
                                $sql = "SELECT * FROM PAPER WHERE Type='0' ";
                                $result = mysqli_query($link, $sql);
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row["Teacher"] . "</td>";
                                    echo "<td>" . $row["Name"] . "</td>";  
                                    echo "<td>" . $row["Date"] . "</td>"; 
                                    echo "<td>" . $row["Page"] . "</td>"; 
                                    echo "<td>" . $row["Source"] . "</td>";                                  
                                    echo "<td>" . $row["Num"] . "</td>";
                                    echo "<td>" . $row["Place"] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">專書論文</h3>
                            <table width = 1000 >
                                <?php
                                $sql = "SELECT * FROM PAPER WHERE Type='1' ";
                                $result = mysqli_query($link, $sql);
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row["Teacher"] . "</td>";
                                    echo "<td>" . $row["Name"] . "</td>";  
                                    echo "<td>" . $row["Date"] . "</td>"; 
                                    echo "<td>" . $row["Page"] . "</td>";                                   
                                    echo "<td>" . $row["Source"] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </section>
            <hr class="m-0" />

            <section class="resume-section" id="plan">
                <div class="resume-section-content">
                    <h2 class="mb-5">參與計畫</h2>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">產學合作</h3>
                            <!--div class="subheading mb-3">Bachelor of Science</div>
                            <div>Computer Science - Web Development Track</div>
                            <p>GPA: 3.23</p-->
                            <table width = 1000>
                                <?php
                                $sql = "SELECT * FROM PLAN WHERE Type='1' ";
                                $result = mysqli_query($link, $sql);
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row["Name"] . "</td>"; 
                                    echo "<td>" . $row["Role"] . "</td>"; 
                                    echo "<td>" . $row["Date"] . "</td>"; 
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">科技部計畫</h3>
                            <!--div class="subheading mb-3">Technology Magnet Program</div>
                            <p>GPA: 3.56</p-->
                            <table width = 1000>
                                <?php
                                $sql = "SELECT * FROM PLAN WHERE Type='0' ";
                                $result = mysqli_query($link, $sql);
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row["Name"] . "</td>"; 
                                    echo "<td>" . $row["Role"] . "</td>"; 
                                    echo "<td>" . $row["Date"] . "</td>"; 
                                    echo "<td>" . $row["Number"] . "</td>"; 
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                        <!--div class="flex-shrink-0"><span class="text-primary">August 2002 - May 2006</span></div-->
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">演講</h3>
                            <!--div class="subheading mb-3">Technology Magnet Program</div>
                            <p>GPA: 3.56</p-->
                            <table width = 1000>
                                <?php
                                $sql = "SELECT * FROM PLAN WHERE Type='2' ";
                                $result = mysqli_query($link, $sql);
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row["Name"] . "</td>"; 
                                    echo "<td>" . $row["Role"] . "</td>"; 
                                    echo "<td>" . $row["Date"] . "</td>";  
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                        <!--div class="flex-shrink-0"><span class="text-primary">August 2002 - May 2006</span></div-->
                    </div>
            </section>
            <!-- Awards-->
            <section class="resume-section" id="awards">
                <div class="resume-section-content">
                    <h2 class="mb-5">獲得獎項</h2>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">校內</h3>
                            <!--div class="subheading mb-3">Bachelor of Science</div>
                            <div>Computer Science - Web Development Track</div>
                            <p>GPA: 3.23</p-->
                            <table width = 1000>
                                <?php
                                $sql = "SELECT * FROM AWARD WHERE Type='1' ";
                                $result = mysqli_query($link, $sql);
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row["Year"] . "</td>"; 
                                    echo "<td>" . $row["Name"] . "</td>"; 
                                    echo "<td>" . $row["Uint"] . "</td>";
                                    echo "<td>" . $row["Date"] . "</td>";
                                    echo "<td>" . $row["Award"] . "</td>"; 
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">校外</h3>
                            <!--div class="subheading mb-3">Technology Magnet Program</div>
                            <p>GPA: 3.56</p-->
                            <table width = 1000>
                                <?php
                                $sql = "SELECT * FROM AWARD WHERE Type='0' ";
                                $result = mysqli_query($link, $sql);
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row["Name"] . "</td>"; 
                                    echo "<td>" . $row["Role"] . "</td>"; 
                                    echo "<td>" . $row["Date"] . "</td>"; 
                                    echo "<td>" . $row["Number"] . "</td>"; 
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                        <!--div class="flex-shrink-0"><span class="text-primary">August 2002 - May 2006</span></div-->
                    </div>
                </div>
            </section>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
