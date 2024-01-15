<?php function echo_drivers_cards($name_list, $lastname_list, $flag_list, $team_list, $number_list, $img_list, $col_card): void { ?>
    <div class="row">
        <?php for ($i = 0; $i < 20; $i++) { ?>
            <div class="<?php echo $col_card ?> d-flex align-items-stretch py-3">
                <div class="card border border-danger border-3 p-2 d-flex flex-column justify-content-between">
                    <div class="card-img">
                        <img src="<?php echo $img_list[$i] ?>" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body d-flex align-items-end">
                        <div class="w-100">
                            <h6 class="card-title text-danger"><?php echo $name_list[$i]."\t".$lastname_list[$i]; ?> </h6>
                            <hr>
                            <p><strong>National: </strong><img style="position: relative; left:75px; height: 20px; width: 30px" src="<?php echo $flag_list[$i] ?>" alt="..."></p>
                            <p><strong>Number: </strong><img style="position: relative; left:70px; height: 20px; width: 40px" src="<?php echo $number_list[$i] ?>" alt="..."></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <br>
<?php } ?>
