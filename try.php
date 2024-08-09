$sql = "SELECT MAX(INVOICE_NO) as max_invoice_no FROM invoice";
                    $result = $con->query($sql);
                    $row = $result->fetch_assoc();
                    $lastInvoiceNo = $row['max_invoice_no'];

                    $nextInvoiceNo = $lastInvoiceNo + 1;

                    if (isset($_POST["submit"])) {

                        $uid = mysqli_real_escape_string($con, $_POST["uid"]);
                        $invoice_no = $nextInvoiceNo;
                        $invoice_date = date("Y-m-d", strtotime($_POST["invoice_date"]));
                        $cname = mysqli_real_escape_string($con, $_POST["cname"]);
                        $caddress = mysqli_real_escape_string($con, $_POST["caddress"]);
                        $ccity = mysqli_real_escape_string($con, $_POST["ccity"]);
                        $grand_total = mysqli_real_escape_string($con, $_POST["grand_total"]);

                        $sql21 = "insert into invoice (INVOICE_NO,INVOICE_DATE,CNAME,CADDRESS,CCITY,GRAND_TOTAL,uid) values ('{$invoice_no}','{$invoice_date}','{$cname}','{$caddress}','{$ccity}','{$grand_total}','$uid') ";

                        if ($con->query($sql21)) {
                            $sid = $con->insert_id;

                            $sql2 = "insert into invoice_products (SID,PNAME,PRICE,QTY,GST,TOTAL) values ";
                            $rows = [];
                            for ($i = 0; $i < count($_POST["pname"]); $i++) {
                                $pname = mysqli_real_escape_string($con, $_POST["pname"][$i]);
                                $price = mysqli_real_escape_string($con, $_POST["price"][$i]);
                                $qty = mysqli_real_escape_string($con, $_POST["qty"][$i]);
                                $gst = mysqli_real_escape_string($con, $_POST["gst"][$i]);
                                $total = mysqli_real_escape_string($con, $_POST["total"][$i]);
                                $rows[] = "('$sid','$pname','$price','$qty','$gst','$total')";
                            }
                            $sql2 .= implode(",", $rows);
                            if ($con->query($sql2)) {
                                echo "<div class='alert alert-success'>Invoice Added Successfully. <a href='print1.php?id={$sid}' target='_BLANK'>Click </a> here to Print Invoice </div> ";

                            } else {
                                echo "<div class='alert alert-danger'>Invoice Added Failed.</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>Invoice Added Failed.</div>";
                        }

                    }

                    ?>
                    <form method='post' action='home.php' autocomplete='off'>