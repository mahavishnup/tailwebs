<?php
declare(strict_types=1);
session_start();
include("inc/config.php");
if (!isset($_SESSION["uid"])) {
    header("location:index.php");
}
$title = 'Dashboard';
require_once 'src/functions.php';
$meta = getMetaSeo(['title' => $title]);
require_once 'inc/header.php';

global $con;

$studentQuery = $con->query("SELECT * FROM students");
$students = $studentQuery->fetchAll(PDO::FETCH_ASSOC);

?>

    <div class="wrapper indexPage container">
        <div class="mainSection">
            <div class="searchContainer">
                <div class="d-flex justify-content-between mb-4">
                    <h2><b>Dashboard</b></h2>

                    <button type="button" class="searchButton" data-bs-toggle="modal"
                            data-bs-target="#staticBackdropCreate">
                        Add New
                    </button>

                    <a href="logout.php"><b>Logout</b> </a>
                </div>

                <div class="table-responsive w-100 h-100">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th scope="col">S.NO</th>
                            <th scope="col">Name</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Mark</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($students as $k => $student) { ?>
                            <tr>
                                <th scope="row"><?php echo $k + 1 ?></th>
                                <td><?php echo @$student['name'] ?></td>
                                <td><?php echo @$student['subject'] ?></td>
                                <td><?php echo @$student['mark'] ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="dropdown-item" type="button"
                                                        onclick="onEditStudent('<?php echo $k ?>', '<?php echo @$student['uid'] ?>')"
                                                        data-bs-toggle="modal" data-bs-target="#staticBackdropEdit">Edit
                                                </button>
                                            </li>
                                            <li>
                                                <form action="delete.php" method="POST" autocomplete="off">
                                                    <input type="hidden" name="sid"
                                                           value="<?php echo @$student['uid'] ?>"/>
                                                    <input class="dropdown-item" type="submit" name="DELETE"
                                                           value="Delete"/>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div></div>
                </div>
            </div>

            <script type="text/javascript">
                const students = <?php echo json_encode($students); ?>;

                function onEditStudent(key, uid) {
                    const label = document.getElementById('staticBackdropLabele');
                    const sid = document.getElementById('side');
                    const sname = document.getElementById('namee');
                    const ssub = document.getElementById('subjecte');
                    const sma = document.getElementById('marke');

                    const student = students[key];
                    if (uid != student?.uid) {
                        alert('Something went to wrong!');

                        return;
                    }

                    label.innerText = `${student?.name} record edit`;
                    sid.value = student?.uid;
                    sname.value = student?.name;
                    ssub.value = student?.subject;
                    sma.value = student?.mark;
                }
            </script>

            <div class="modal fade" id="staticBackdropCreate" data-bs-backdrop="static" data-bs-keyboard="false"
                 tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-black" id="staticBackdropLabel">Create New Student</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="staticBackdropBody">
                            <form action="create.php" method="POST" autocomplete="off">
                                <div class="mb-3">
                                    <label for="name" class="form-label text-black">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           aria-describedby="nameHelp" required>
                                    <div id="nameHelp" class="form-text">Name and Subject same record could not be
                                        valid. Unique name and different subject.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label text-black">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject"
                                           aria-describedby="subjectHelp" required>
                                    <div id="subjectHelp" class="form-text">Name and Subject same record could not be
                                        valid. Unique name and different subject.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="mark" class="form-label text-black">Mark</label>
                                    <input type="number" class="form-control" id="mark" name="mark" required>
                                </div>
                                <div class="text-center">
                                    <input class="btn btn-primary" type="submit" name="CREATE" value="Create"/>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="staticBackdropEdit" data-bs-backdrop="static" data-bs-keyboard="false"
                 tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-black" id="staticBackdropLabele">Edit Student Record</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="staticBackdropBody">
                            <form action="edit.php" method="POST" autocomplete="off">
                                <input type="hidden" name="sid" id="side" value="" required/>
                                <div class="mb-3">
                                    <label for="namee" class="form-label text-black">Name</label>
                                    <input type="text" class="form-control" id="namee" name="name"
                                           aria-describedby="nameeHelp" required>
                                    <div id="nameeHelp" class="form-text">Name and Subject same record could not be
                                        valid. Unique name and different subject.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="subjecte" class="form-label text-black">Subject</label>
                                    <input type="text" class="form-control" id="subjecte" name="subject"
                                           aria-describedby="subjecteHelp" required>
                                    <div id="subjecteHelp" class="form-text">Name and Subject same record could not be
                                        valid. Unique name and different subject.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="marke" class="form-label text-black">Mark</label>
                                    <input type="number" class="form-control" id="marke" name="mark" required>
                                </div>
                                <div class="text-center">
                                    <input class="btn btn-primary" type="submit" name="UPDATE" value="Update"/>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require_once 'inc/footer.php';
?>