<?php

//To Handle Session Variables on This Page


session_start();


//Including Database Connection From db.php file to avoid rewriting in all files
require_once("../db.php");



if (isset($_POST['submit'])) {

    // they take values using name attribute 
    $subject = $_POST['subject'];
    $notice = $_POST['input'];
    $audience = $_POST['audience'];


    //Folder where you want to save your resume. THIS FOLDER MUST BE CREATED BEFORE TRYING
    $folder_dir = "../uploads/resume/";

    //Getting Basename of file. So if your file location is Documents/New Folder/myResume.pdf then base name will return myResume.pdf
    $base = basename($_FILES['resume']['name']);

    //This will get us extension of your file. So myResume.pdf will return pdf. If it was resume.doc then this will return doc.
    $resumeFileType = pathinfo($base, PATHINFO_EXTENSION);

    //Setting a random non repeatable file name. Uniqid will create a unique name based on current timestamp. We are using this because no two files can be of same name as it will overwrite.
    $file = uniqid() . "." . $resumeFileType;

    //This is where your files will be saved so in this case it will be uploads/resume/newfilename
    $filename = $folder_dir . $file;

    //We check if file is saved to our temp location or not.
    if (file_exists($_FILES['resume']['tmp_name'])) {




        move_uploaded_file(
            $_FILES["resume"]["tmp_name"],
            $filename
        );
    }




    $hash = md5(uniqid());






    $sql = "INSERT INTO notice(subject,notice,audience,resume, hash,`date`) VALUES ('$subject','$notice','$audience','$file', '$hash',now())";

    if ($conn->query($sql) === TRUE) {
        include 'sendmail.php';
        header("Location: postnotice.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </div>

    </div>


    <footer class="main-footer" style="margin:auto;margin-bottom: 0px; padding:15px;
  width: 100%;
  height: 50px; position:absolute; background-color:#1f0a0a; color:white">
        <div class="text-center">
            <strong>Copyright &copy; 2022 Placement Portal</strong> All rights
            reserved.
        </div>
    </footer>

</body>

</html>


<style>
    body {

        /* background-color: #bccde5;
         */
        background-color: white;
    }

    .centre {
        margin: 20px 30px 100px 20px;
        text-align: center;
        height: 450px;
        width: 700px;
        border: 2px solid black;
        border-radius: 10px;
        /* display: inline-grid; */
        display: inline-block;


    }

    #subject {

        width: 86%;


    }

    .option {
        width: 30%;
        margin: auto;
    }

    .input {

        height: 200px;
        width: 600px;
        border-radius: 5px;
        background-color: white;
        text-align: center;


    }

    .button {


        background-color: #3e79c8;

        /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 0px 10px 0px 10px;
    }

    @media screen and (max-width: 1447px) {

        .input1 {
            width: auto;
            height: auto;
        }

        .centre {

            height: 105%;
            width: 105%;
            margin-left: 100px;

        }

        .responsive2 {
            margin: auto;
            display: block;
            height: 80%;
            width: 80%;
            margin: auto;
        }

        #subject {
            height: 60%;
            width: 60%;
            margin: auto;

        }

        .option {
            height: 60%;
            width: 60%;
            margin: auto;
        }

        .input {
            height: 80%;
            width: 60%;
            margin: auto;

        }


    }
</style>
