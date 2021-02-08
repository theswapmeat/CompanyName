<<  HTML file >>

<div class="form-group">
    <label for="inputInsuredName">Insured Name</label>
    <input <?= $invalid_class_name ?? "" ?>class="form-control" type="text" placeholder="Project Company/SPV Name" id="inputInsuredName" name="insuredname">
</div>

javascript ---
$("#inputInsuredName").focusout(function() {
            var insuredname = $(this).val();
            $(this).fadeIn();

            $.ajax({
                url: './process-controller.php',
                type: 'POST',
                data: {
                    framId: insuredname
                },
                dataType: 'JSON',

                success: function(result) {
                    var insuredcount = "";
//I don't know what to put here to trigger the class change in the object in line 5 above.
                }
            });
        });

<< process-controller.php >>
 elseif(isset($_POST['insuredname'])) {
        $insuredname        =       $_POST['insuredname'];

        $dController        =       new DataController();
        
        $insurednamecount   =       $dController->insuredcount($insuredname);

        echo json_encode($insurednamecount);

    }
    
<< data controller.php >>
// --------------- [ Insured Name Listing ] -------------------------
        public function insuredcount($insuredname) {
        $data           =           array();  //Should this be changed??????

        $db             =           new DBController();
        $conn           =           $db->connect();
        $sql            =           "SELECT COUNT(*) FROM tbl_Assets WHERE A_InsuredName = '$insuredname'";
        $result         =           $conn->query($sql);

        if($result->num_rows > 0) {
            $data       =           mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        $db->close($conn);
        return $data;
        }
