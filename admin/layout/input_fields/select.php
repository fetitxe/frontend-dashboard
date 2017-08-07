<?php
function fed_admin_input_fields_select($row, $action ) {
	?>
    <div class="row fed_input_type_container fed_input_dropdown_container hide">
        <form method="post"
              class="fed_admin_menu fed_ajax"
              action="<?php echo admin_url( 'admin-ajax.php?action=fed_admin_setting_up_form' ) ?>">

			<?php wp_nonce_field( 'fed_admin_setting_up_nonce', 'fed_admin_setting_up_nonce' ) ?>

			<?php echo fed_loader(); ?>

            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><b>Select / Dropdown</b></h3>
                    </div>
                    <div class="panel-body">
                        <div class="fed_input_text">
							<?php fed_get_admin_up_label_input_order( $row ); ?>
                            <div class="row">
								<?php fed_get_admin_up_input_meta( $row ) ?>

                                <div class="form-group col-md-3">
                                    <label for="">Class Name</label>
									<?php echo fed_input_box( 'class_name', array( 'value' => $row['class_name'] ), 'text' ); ?>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="">ID Name</label>
									<?php echo fed_input_box( 'id_name', array( 'value' => $row['id_name'] ), 'text' ); ?>
                                </div>

                            </div>
							<?php
							fed_get_admin_up_display_permission( $row, $action );

							fed_get_admin_up_role_based($row, $action  );
							?>

                            <div class="row fed_key_value_paid">
                                <div class="col-md-5">
                                    <label for="">Values</label>
									<?php echo fed_input_box( 'input_value', array(
										'placeholder' => 'Please enter the value by key,value',
										'rows'        => 10,
										'value'       => $row['input_value']
									), 'textarea' ); ?>
                                </div>
                                <div class="col-md-7">
                                    <div class="row fed_key_value_eg_container">
                                        <div class="col-md-5">
                                            <label for="">Examples:</label>
                                            <p>key,value</p>
                                            <p>one,One</p>
                                            <p>two,Two</p>
                                            <p>five-category,Five Category</p>
                                        </div>
                                        <div class="col-md-7">
                                            <b>This will be output as</b>
											<?php
											$value = array(
												'key'           => 'Value',
												'one'           => 'One',
												'two'           => 'Two',
												'five-category' => 'Five Category'
											);
											echo fed_input_box( 'fed_dummy_radio', array( 'options' => $value ), 'select' );
											?>
                                        </div>
                                    </div>
                                </div>
                            </div>

							<?php
							fed_get_input_type_and_submit_btn( 'select', $action );
							?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
	<?php
}