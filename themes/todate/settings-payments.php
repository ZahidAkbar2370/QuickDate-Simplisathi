<?php
$admin_mode = false;
if( $profile->admin == '1' || CheckPermission($profile->permission, "manage-users")){
    $target_user = route(2);
    $_user = LoadEndPointResource('users');
    if( $_user ){
        if( $target_user !== '' ){
            $profile = $_user->get_user_profile(Secure($target_user));
            if( !$profile ){
                echo '<script>window.location = window.site_url;</script>';
                exit();
            }else{
                $user = $profile;
                if( $profile->admin == '1' ){
                    $admin_mode = true;
                }
            }
        }
    }
}else{
    $user = auth();
}
?>
<?php //$user = auth();?>

<!-- Settings  -->
<div class="container page-margin">
<div class="row to_sett_row">
	<div class="col m12 l4">
		<div class="sett_navbar">
            <ul class="browser-default">
                <li class="general">
					<a href="<?php echo $site_url;?>/settings/<?php echo $profile->username;?>" data-ajax="/settings/<?php echo $profile->username;?>" target="_self"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M12 1l9.5 5.5v11L12 23l-9.5-5.5v-11L12 1zm0 14a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" fill="currentColor"/></svg></span> <?php echo __( 'General' );?></a>
				</li>
                <li class="profile">
					<a href="<?php echo $site_url;?>/settings-profile/<?php echo $profile->username;?>" data-ajax="/settings-profile/<?php echo $profile->username;?>" target="_self"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M20 22H4v-2a5 5 0 0 1 5-5h6a5 5 0 0 1 5 5v2zm-8-9a6 6 0 1 1 0-12 6 6 0 0 1 0 12z" fill="currentColor"/></svg></span> <?php echo __( 'Profile' );?></a>
				</li>
				<?php if( $config->social_media_links == 'on' ){ ?>
					<li class="social">
						<a href="<?php echo $site_url;?>/settings-social/<?php echo $profile->username;?>" data-ajax="/settings-social/<?php echo $profile->username;?>" target="_self"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M13.06 8.11l1.415 1.415a7 7 0 0 1 0 9.9l-.354.353a7 7 0 0 1-9.9-9.9l1.415 1.415a5 5 0 1 0 7.071 7.071l.354-.354a5 5 0 0 0 0-7.07l-1.415-1.415 1.415-1.414zm6.718 6.011l-1.414-1.414a5 5 0 1 0-7.071-7.071l-.354.354a5 5 0 0 0 0 7.07l1.415 1.415-1.415 1.414-1.414-1.414a7 7 0 0 1 0-9.9l.354-.353a7 7 0 0 1 9.9 9.9z" fill="currentColor"/></svg></span> <?php echo __( 'Social Links' );?></a>
					</li>
				<?php } ?>
				<hr class="border_hr">
                <li class="privacy">
					<a href="<?php echo $site_url;?>/settings-privacy/<?php echo $profile->username;?>" data-ajax="/settings-privacy/<?php echo $profile->username;?>" target="_self"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M3.783 2.826L12 1l8.217 1.826a1 1 0 0 1 .783.976v9.987a6 6 0 0 1-2.672 4.992L12 23l-6.328-4.219A6 6 0 0 1 3 13.79V3.802a1 1 0 0 1 .783-.976zM13 10V5l-5 7h3v5l5-7h-3z" fill="currentColor"/></svg></span> <?php echo __( 'Privacy' );?></a>
				</li>
				<li class="emails">
					<a href="<?php echo $site_url;?>/settings-sessions/<?php echo $profile->username;?>" data-ajax="/settings-sessions/<?php echo $profile->username;?>" target="_self"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M17 13v1c0 2.77-.664 5.445-1.915 7.846l-.227.42-1.747-.974c1.16-2.08 1.81-4.41 1.882-6.836L15 14v-1h2zm-6-3h2v4l-.005.379a12.941 12.941 0 0 1-2.691 7.549l-.231.29-1.55-1.264a10.944 10.944 0 0 0 2.471-6.588L11 14v-4zm1-4a5 5 0 0 1 5 5h-2a3 3 0 0 0-6 0v3c0 2.235-.82 4.344-2.271 5.977l-.212.23-1.448-1.38a6.969 6.969 0 0 0 1.925-4.524L7 14v-3a5 5 0 0 1 5-5zm0-4a9 9 0 0 1 9 9v3c0 1.698-.202 3.37-.597 4.99l-.139.539-1.93-.526c.392-1.437.613-2.922.658-4.435L19 14v-3A7 7 0 0 0 7.808 5.394L6.383 3.968A8.962 8.962 0 0 1 12 2zM4.968 5.383l1.426 1.425a6.966 6.966 0 0 0-1.39 3.951L5 11 5.004 13c0 1.12-.264 2.203-.762 3.177l-.156.29-1.737-.992c.38-.665.602-1.407.646-2.183L3.004 13v-2a8.94 8.94 0 0 1 1.964-5.617z" fill="currentColor"/></svg></span> <?php echo __( 'Manage Sessions' );?></a>
				</li>
                <?php if( $config->two_factor == '1' ){ ?>
					<li class="profile">
						<a href="<?php echo $site_url;?>/settings-twofactor/<?php echo $profile->username;?>" data-ajax="/settings-twofactor/<?php echo $profile->username;?>" target="_self"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M2,7V9H6V11H4A2,2 0 0,0 2,13V17H8V15H4V13H6A2,2 0 0,0 8,11V9C8,7.89 7.1,7 6,7H2M9,7V17H11V13H14V11H11V9H15V7H9M18,7A2,2 0 0,0 16,9V17H18V14H20V17H22V9A2,2 0 0,0 20,7H18M18,9H20V12H18V9Z" fill="currentColor"/></svg></span> <?php echo __( 'Two-factor authentication' );?></a>
					</li>
				<?php } ?>
				<li class="general">
					<a href="<?php echo $site_url;?>/my-info/<?php echo $profile->username;?>" data-ajax="/my-info/<?php echo $profile->username;?>" target="_self"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-11v6h2v-6h-2zm0-4v2h2V7h-2z" fill="currentColor"/></svg></span> <?php echo __( 'My Information' );?></a>
				</li>
				<hr class="border_hr">
				<?php if( $config->invite_links_system == '1' ){ ?>
					<li class="social">
						<a href="<?php echo $site_url;?>/settings-links/<?php echo $profile->username;?>" data-ajax="/settings-links/<?php echo $profile->username;?>" target="_self"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M14 14.252V22H4a8 8 0 0 1 10-7.748zM12 13c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm6 4v-3h2v3h3v2h-3v3h-2v-3h-3v-2h3z" fill="currentColor"/></svg></span> <?php echo __( 'Invitation Links' );?></a>
					</li>
				<?php } ?>
				<?php if( $config->affiliate_system == '1' ){ ?>
					<li class="general">
						<a href="<?php echo $site_url;?>/settings-affiliate/<?php echo $profile->username;?>" data-ajax="/settings-affiliate/<?php echo $profile->username;?>" target="_self"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M12 11a5 5 0 0 1 5 5v6H7v-6a5 5 0 0 1 5-5zm-6.712 3.006a6.983 6.983 0 0 0-.28 1.65L5 16v6H2v-4.5a3.5 3.5 0 0 1 3.119-3.48l.17-.014zm13.424 0A3.501 3.501 0 0 1 22 17.5V22h-3v-6c0-.693-.1-1.362-.288-1.994zM5.5 8a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zm13 0a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM12 2a4 4 0 1 1 0 8 4 4 0 0 1 0-8z" fill="currentColor"/></svg></span> <?php echo __( 'My affiliates' );?></a>
					</li>
				<?php } ?>
				<?php if( $config->emailNotification == '1' ){ ?>
					<li class="emails">
						<a href="<?php echo $site_url;?>/settings-email/<?php echo $profile->username;?>" data-ajax="/settings-email/<?php echo $profile->username;?>" target="_self"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M3 3h18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm9.06 8.683L5.648 6.238 4.353 7.762l7.72 6.555 7.581-6.56-1.308-1.513-6.285 5.439z" fill="currentColor"/></svg></span> <?php echo __( 'Manage Notifications' );?></a>
					</li>
				<?php } ?>
				<li class="password">
					<a href="<?php echo $site_url;?>/settings-password/<?php echo $profile->username;?>" data-ajax="/settings-password/<?php echo $profile->username;?>" target="_self"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M18 8h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h2V7a6 6 0 1 1 12 0v1zm-2 0V7a4 4 0 1 0-8 0v1h8zm-5 6v2h2v-2h-2zm-4 0v2h2v-2H7zm8 0v2h2v-2h-2z" fill="currentColor"/></svg></span> <?php echo __( 'Password' );?></a>
				</li>
				<hr class="border_hr">
                <li class="block">
					<a href="<?php echo $site_url;?>/settings-blocked/<?php echo $profile->username;?>" data-ajax="/settings-blocked/<?php echo $profile->username;?>" target="_self"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM8.523 7.109l8.368 8.368a6.04 6.04 0 0 1-1.414 1.414L7.109 8.523A6.04 6.04 0 0 1 8.523 7.11z" fill="currentColor"/></svg></span> <?php echo __( 'Blocked Users' );?></a>
				</li>
                <?php if( $admin_mode == false && $config->deleteAccount == '1' ) {?>
					<li class="delete">
						<a href="<?php echo $site_url;?>/settings-delete/<?php echo $profile->username;?>" data-ajax="/settings-delete/<?php echo $profile->username;?>" target="_self"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M7 6V3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3h5v2h-2v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8H2V6h5zm2-2v2h6V4H9z" fill="currentColor"/></svg></span> <?php echo __( 'Delete Account' );?></a>
					</li>
				<?php } ?>
            </ul>
        </div>
	</div>
	<div class="col m12 l8">
		<div class="dt_settings">
			<h2 class="user_sttng_panel_hd"><?php echo __('My balance');?>: <?php echo $config->currency_symbol;?><?php echo number_format($profile->aff_balance, 2);?></h2>
			<?php if( (float)$profile->aff_balance < (float)$config->m_withdrawal ){ ?>
				<div class="alert alert-info"><?php echo __('Your balance is');?> <?php echo $config->currency_symbol;?><?php echo number_format($profile->aff_balance, 2);?> <?php echo __(', minimum withdrawal request is');?> <?php echo $config->currency_symbol;?><?php echo number_format($config->m_withdrawal, 2);?></div>
            <?php }?>
			<?php if( (float)$profile->aff_balance >= (float)$config->m_withdrawal ){ ?>
				<form method="post" action="/profile/request_payment">
					<div class="alert alert-success" role="alert" style="display:none;"></div>
					<div class="alert alert-danger" role="alert" style="display:none;"></div>
					<div class="row">
						<div class="col l12">
							<div class="to_mat_input">
								<select id="withdraw_method" name="withdraw_method" onchange="ShowWithdrawMethod(this)" class="browser-default pp_select_has_label">
									<?php 
									$first = 0;
									foreach ($config->withdrawal_payment_method as $key => $value) { 
										if ($value == 1) {
											if ($first == 0) {
												$first = $key;
											}
											if ($key != 'custom') { ?>
												<option value="<?php echo $key; ?>"><?php echo __($key); ?></option>
									<?php   }elseif(!empty($config->custom_name)){ ?>
											<option value="<?php echo $key; ?>"><?php echo $config->custom_name; ?></option>
									<?php }}} ?>
								</select>
								<label for="withdraw_method"><?php echo __( 'Withdraw Method' );?></label>
							</div>
						</div>
						<div class="col l6 paypal_withdrawal" <?php echo($first == 'paypal' ? '' : 'style="display: none;"'); ?>>
							<div class="to_mat_input">
								<input name="paypal_email" id="paypal_email" class="browser-default" type="text" placeholder="<?php echo __( 'PayPal email' );?>" value="<?php echo $profile->paypal_email;?>" autofocus>
								<label for="paypal_email"><?php echo __( 'PayPal email' );?></label>
							</div>
						</div>
						<div class="col l6">
							<div class="to_mat_input">
								<input name="amount" id="amount" class="browser-default" type="text" placeholder="<?php echo __( 'Amount' );?>">
								<label for="amount"><?php echo __( 'Amount' );?></label>
							</div>
						</div>
						<div class="transfer_to_withdrawal" <?php echo(($first == 'skrill' || $first == 'custom') ? '' : 'style="display: none;"'); ?>>
							<div class="col l6">
								<div class="to_mat_input">
									<input name="transfer_to" id="transfer_to" type="text" class="browser-default" placeholder="<?php echo __('transfer_to');?>">
									<label for="transfer_to"><?php echo __('transfer_to'); ?></label>
									<span class="help-block checking"></span>
								</div>
							</div>
						</div>
						<div class="bank_withdrawal" <?php echo($first == 'bank' ? '' : 'style="display: none;"'); ?>>
							<div class="col l6">
								<div class="to_mat_input">
									<input id="iban" name="iban" type="text" class="browser-default" placeholder="<?php echo __('iban');?>">
									<label for="iban"><?php echo __('iban');?></label>
								</div>
							</div>
							<div class="col l6">
								<div class="to_mat_input">
									<input id="country" name="country" type="text" class="browser-default" placeholder="<?php echo __('Country');?>">
									<label for="country"><?php echo __('Country');?></label>
								</div>
							</div>
							<div class="col l6">
								<div class="to_mat_input">
									<input id="full_name" name="full_name" type="text" class="browser-default" placeholder="<?php echo __('Full Name');?>">
									<label for="full_name"><?php echo __('Full Name');?></label>
								</div>
							</div>
							<div class="col l6">
								<div class="to_mat_input">
									<input id="swift_code" name="swift_code" type="text" class="browser-default" placeholder="<?php echo __('Swift Code');?>">
									<label for="swift_code"><?php echo __('Swift Code');?></label>
								</div>
							</div>
							<div class="col l12">
								<div class="to_mat_input">
									<textarea name="address" id="address" rows="4" placeholder="<?php echo __('Address');?>"></textarea>
									<label for="address"><?php echo __('Address');?></label>
								</div>
							</div>
						</div>
					</div>
					<div class="dt_sett_footer">
						<button class="btn btn-large bold btn_primary btn_round" type="submit" name="action"><span><?php echo __( 'Request withdrawal' );?></span> <svg viewBox="0 0 19 14" xmlns="http://www.w3.org/2000/svg" width="18" height="18"><path fill="currentColor" d="M18.6 6.9v-.5l-6-6c-.3-.3-.9-.3-1.2 0-.3.3-.3.9 0 1.2l5 5H1c-.5 0-.9.4-.9.9s.4.8.9.8h14.4l-4 4.1c-.3.3-.3.9 0 1.2.2.2.4.2.6.2.2 0 .4-.1.6-.2l5.2-5.2h.2c.5 0 .8-.4.8-.8 0-.3 0-.5-.2-.7z"></path></svg></button>
					</div>
				</form>
            <?php }?>
		</div>
		<div class="dt_settings">
			<div class="dt_usr_pmnt_hstry">
                <h5><?php echo __('Payment history'); ?></h5>
                <div class="table-responsive">
                    <table class="table table-condensed dt_usr_pmnt_table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo __('amount'); ?></th>
                            <th><?php echo __('requested'); ?></th>
                            <th><?php echo __('status'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $get_payment = Wo_GetPaymentsHistory($profile->id);
                        if (count($get_payment) > 0) {
                            foreach ($get_payment as $wo['key'] => $wo['payment']) {
                                $wo['key'] = ($wo['key'] + 1);
                                $wo['html_class'] = 'label-warning';
                                $wo['html_text'] = __('pending review');
                                if ($wo['payment']['status'] == '1') {
                                    $wo['html_class'] = 'label-success';
                                    $wo['html_text'] = __('approved');
                                } else if ($wo['payment']['status'] == '2') {
                                    $wo['html_class'] = 'label-danger';
                                    $wo['html_text'] = __('declined');
                                } else if ($wo['payment']['status'] == '0') {
                                    $wo['html_class'] = 'label-danger';
                                    $wo['html_text'] = __('pending review');
                                }
                                ?>
                                <tr>
                                    <td><?php echo $wo['key']?></td>
                                    <td><?php echo $config->currency_symbol . $wo['payment']['amount']?></td>
                                    <td><?php echo $wo['payment']['time_text']?></td>
                                    <td><span class="label label-status <?php echo $wo['html_class']?>"><?php echo $wo['html_text'];?></span></td>
                                </tr>
                            <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
	</div>
</div>
</div>
<!-- End Settings  -->
<script type="text/javascript">
    function ShowWithdrawMethod(self) {
        if ($(self).val() == 'bank') {
            $('.paypal_withdrawal').slideUp();
            $('.transfer_to_withdrawal').slideUp();
            $('.bank_withdrawal').slideDown();
        }
        else if($(self).val() == 'paypal'){
            $('.bank_withdrawal').slideUp();
            $('.transfer_to_withdrawal').slideUp();
            $('.paypal_withdrawal').slideDown();
        }
        else{
            $('.bank_withdrawal').slideUp();
            $('.transfer_to_withdrawal').slideDown();
            $('.paypal_withdrawal').slideUp();
        }
    }
</script>