<?php
session_start();
include "../database/connect.php";

if (!isset($_SESSION['username'])) {
    header('Location: ../login/.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashboradTeacher</title>
    <link rel="icon" href="../img/ssrw.png">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 10px;
        }
    </style>
</head>

<body>
    <!-- < ?php include "header_teacher.php" ?> -->
    <?php include "header_teacher.php" ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mt-4">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4" />
                                </svg>
                                นักเรียนชั้นมัธยมศึกษาปีที่ 1
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="student1.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4" />
                                </svg>
                                นักเรียนชั้นมัธยมศึกษาปีที่ 4
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="student4.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-bar-graph-fill" viewBox="0 0 16 16">
                                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m.5 10v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5m-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5z" />
                                </svg>
                                ความสามรถพิเศษของนักเรียน
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="special.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-black mb-4">
                            <div class="card-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-calendar2-week-fill" viewBox="0 0 16 16">
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5m9.954 3H2.545c-.3 0-.545.224-.545.5v1c0 .276.244.5.545.5h10.91c.3 0 .545-.224.545-.5v-1c0-.276-.244-.5-.546-.5M8.5 7a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM3 10.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5m3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                                </svg>
                                ปีการศึกษาย้อนหลัง
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-black stretched-link" href="year.php">View Details</a>
                                <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ตาราง Username -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        ข้อมูลการสมัครเรียนของนักเรียนชั้นมัธยมศึกษาปีที่ 1 และ 4
                    </div>
                    <div class="card-body">
                        <table class="table table-striped ">
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อ</th>
                                <th>เลขบัตรประชาชน</th>
                                <th>ระดับชั้นมัธยมศึกษา</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>วันเวลาที่สมัครเรียน</th>
                                <th>แผนการเรียน</th>
                                <th>ตรวจสอบเอกสาร</th>
                                <!-- <th>Edit</th> -->
                                <!-- <th>Delete</th> -->
                            </tr>
                            <?php
                            $sql = "SELECT * FROM student ";
                            $result = mysqli_query($conn, $sql);
                            // ดึงข้อมูลในการวนลูปอารเรย์ โดยใช้ลูป while
                            $i = 1;
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <!-- < ? = ? > เป็นคำสั่งแท็กลัด = แทน echo การดึงข้อมูล $row มาจาก ตาราง sql ตามลำดับ-->
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row["name"] ?></td>
                                    <td><?= $row["id_card"] ?></td>
                                    <td><?= $row["mathayom"] ?></td>
                                    <td><?= $row["phone"] ?></td>
                                    <td><?= $row["date_time"] ?></td>
                                    <td><?= $row["room"] ?></td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <a href="check_document.php?student_id=<?= $row['student_id'] ?>&name=<?= urlencode($row['name']) ?>&pay_id=<?= $row['pay_id'] ?>" class="btn btn-success">
                                            <!-- SVG Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                                                <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                            </svg>
                                        </a>

                                    </td>



                                    </td>
                                    <!-- <td>< ?= $row["room"] ?></td> -->
                                    <!-- <td><a href="edit_member.php?id=< ?=$row["id"]?>"><button class="btn btn-warning mb-2">Edit</button></a></td> -->
                                    <!-- <td><a href="delete_student.php?id=< ?=$row[" id"]?><button class="btn btn-danger mb-2" onclick="Del(this.href);return false;">Delete</button></a></td> -->

                                </tr>
                                <!-- มาจากลูป while ด้านบน -->
                            <?php
                                $i++;
                            }
                            mysqli_close($conn); //ปิดการเชื่อมต่อฐานข้อมูลจาก connect
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <?php include "../footer.php" ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>

</body>

</html>