<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';

if (isset($_POST['id'])) {
    updateSettings($_POST);
    $success = "Setttings Updated Successfully.";
    echo '<meta http-equiv="refresh" content="0.5; url=settings.php" />';
}
?>
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active">Settings</li>
            </ul>
        </div>
    </div>
    <!-- /. ROW  -->
    <section>
        <div class="container-fluid">
            <header>
                <h1 class="h3 display">Settings</h1>
            </header>
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button><?php echo $success; ?></div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-12">
                    <form id="data-form" action="settings.php" method="POST">
                        <input type="hidden" name="id" value="1">
                        <div class="card">
                            <div class="card-body">
                                <h4>General Settings</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Site Name</label>
                                            <input type="text" class="form-control" name="sitename" value="<?php echo SITENAME; ?>" placeholder="Name of your site" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Site Keywords</label>
                                            <input type="text" class="form-control" name="keywords" value="<?php echo SITEKEYWORDS; ?>" placeholder="Keywords of your site, separated with comma" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Site Description</label>
                                            <input type="text" class="form-control" name="description" value="<?php echo SITEDESC; ?>" placeholder="Description of your site" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Admin Pagination</label>
                                            <input type="number" step="1" class="form-control" name="pagination" value="<?php echo PAGINATION; ?>" placeholder="Items per page on admin" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4>Social Settings</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Facebook</label>
                                            <input type="url" class="form-control" name="facebook" value="<?php echo SOCIAL_FACEBOOK; ?>" placeholder="Facebook Page or Group URL">
                                            <small class="help-block">Leave blank to deactivate</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Telegram</label>
                                            <input type="url" class="form-control" name="telegram" value="<?php echo SOCIAL_TELEGRAM; ?>" placeholder="Telegram Group or Channel URL">
                                            <small class="help-block">Leave blank to deactivate</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Twitter</label>
                                            <input type="url" class="form-control" name="twitter" value="<?php echo SOCIAL_TWITTER; ?>" placeholder="Twitter Profile URL">
                                            <small class="help-block">Leave blank to deactivate</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>VK</label>
                                            <input type="url" class="form-control" name="vk" value="<?php echo SOCIAL_VK; ?>" placeholder="VK Page or Group URL">
                                            <small class="help-block">Leave blank to deactivate</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4>Limit Settings</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Min. Withdraw</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="min_withdraw" value="<?php echo MINWTHD; ?>" placeholder="Min withdraw value" required>
                                            <div class="input-group-append"><span class="input-group-text"><?php echo CURCOD; ?></span></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Max. Withdraw</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="max_withdraw" value="<?php echo MAXWTHD; ?>" placeholder="Max withdraw value" required>
                                            <div class="input-group-append"><span class="input-group-text"><?php echo CURCOD; ?></span></div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Affiliate Comission</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="aff_comission" value="<?php echo AFFEARN; ?>" placeholder="Affiliate comission percentage" required>
                                            <div class="input-group-append"><span class="input-group-text">%</span></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Min. Affiliate Withdraw</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="min_aff_withdraw" value="<?php echo MINAFWTHD; ?>" placeholder="Min withdraw value affiliate comissions" required>
                                            <div class="input-group-append"><span class="input-group-text"><?php echo CURCOD; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4>Currency Settings</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Currency Name</label>
                                            <input type="text" class="form-control" name="currency_name" value="<?php echo CURNAME; ?>" placeholder="Currency name. Dogecoin, Bitcoin, Litecoin, Ethereum" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Currency Code</label>
                                            <input type="text" class="form-control" name="currency_code" value="<?php echo CURCOD; ?>" placeholder="Currency code. DOGE, BTC, LTC, ETH" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Currency Symbol</label>
                                            <input type="text" class="form-control" name="currency_symbol" value="<?php echo CURSYM; ?>" placeholder="Currency symbol. Đ, Ƀ, Ł, Ξ" required>
                                            <small class="help-block">Examples: Đ, Ƀ, Ł, Ξ</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Decimals</label>
                                            <input type="number" class="form-control" name="currency_decimals" value="<?php echo DECIMALS; ?>" placeholder="Number of decimals to show" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Wallet Address Min Characters</label>
                                            <input type="number" class="form-control" name="wallet_minch" value="<?php echo WALLET_MINCH; ?>" placeholder="Min Characters for Wallet Address Validation" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Wallet Address Max Characters</label>
                                            <input type="number" class="form-control" name="wallet_maxch" value="<?php echo WALLET_MAXCH; ?>" placeholder="Max Characters for Wallet Address Validation" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Blockchain Tracking URL</label>
                                            <select class="form-control" name="blockchain">
                                                <option value="">-- SELECT --</option>
                                                <?php
                                                    $chainUrls = getBlockchainUrls();
                                                    foreach($chainUrls as $burl):
                                                        if($burl->id==BLOCKCHAIN_URL):
                                                            $bSel = 'selected';
                                                        else:
                                                            $bSel = '';
                                                        endif;
                                                        echo '<option value="'.$burl->id.'" '.$bSel.'>'.$burl->name.'</option>';
                                                    endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4>CoinPayments Settings</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Private Key</label>
                                            <input type="text" class="form-control" name="coin_pv" value="<?php echo COINPRIVATE; ?>" placeholder="API Private Key" required>
                                            <small class="help-block">Click <a href="https://www.coinpayments.net/acct-api-keys" target="_blank">here</a> to get your key</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Public Key</label>
                                            <input type="text" class="form-control" name="coin_pb" value="<?php echo COINPUPLIC; ?>" placeholder="API Public Key" required>
                                            <small class="help-block">Click <a href="https://www.coinpayments.net/acct-api-keys" target="_blank">here</a> to get your key</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Merchant ID</label>
                                            <input type="text" class="form-control" name="coin_mid" value="<?php echo COINMID; ?>" placeholder="Merchant ID" required>
                                            <small class="help-block">Click <a href="https://www.coinpayments.net/acct-settings" target="_blank">here</a>. Can be found on 'Basic Settings' tab.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>IPN Secret Key</label>
                                            <input type="text" class="form-control" name="coin_sec" value="<?php echo COINMSEC; ?>" placeholder="IPN secret key" required>
                                            <small class="help-block">Click <a href="https://www.coinpayments.net/acct-settings" target="_blank">here</a>. Set this on 'Merchant Settings' tab, IPN Secret Key.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Site Currency</label>
                                            <input type="text" class="form-control" name="coin_cur1" value="<?php echo COINCUR; ?>" placeholder="Currency used in your site" required>
                                            <small class="help-block">See more about <b>currency1</b> field <a href="https://www.coinpayments.net/apidoc-create-transaction" target="_blank">here</a>.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Receive Currency</label>
                                            <input type="text" class="form-control" name="coin_cur2" value="<?php echo COINCUR2; ?>" placeholder="Currency used to receive payments" required>
                                            <small class="help-block">See more about <b>currency2</b> field <a href="https://www.coinpayments.net/apidoc-create-transaction" target="_blank">here</a>.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Security Hash</label>
                                            <input type="text" class="form-control" name="coin_hash" value="<?php echo COINHASH; ?>" placeholder="Create a secure hash to validate transactions" required>
                                            <small class="help-block">Your security hash to encrypt transactions.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4>Admin Settings</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Admin Username</label>
                                            <input type="text" class="form-control" name="username" value="<?php echo ADMINU; ?>" placeholder="Admin username" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Admin Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Admin password. Leave blank to dont change">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4>Email Settings</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>SMTP Host</label>
                                            <input type="text" class="form-control" name="smtp_host" value="<?php echo SMTP_HOST; ?>" placeholder="SMTP Hostname" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>SMTP Port</label>
                                            <input type="text" class="form-control" name="smtp_port" value="<?php echo SMTP_PORT; ?>" placeholder="SMTP Port Number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>SMTP Secure</label>
                                            <select name="smtp_secure" class="form-control" required>
                                                <option value="ssl" <?php echo (SMTP_SECUR=='ssl')?'selected':''; ?>>SSL</option>
                                                <option value="tsl" <?php echo (SMTP_SECUR=='tsl')?'selected':''; ?>>TSL</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>SMTP Username</label>
                                            <input type="text" class="form-control" name="smtp_user" value="<?php echo SMTP_USER; ?>" placeholder="SMTP username" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>SMTP Password</label>
                                            <input type="password" class="form-control" name="smtp_pass" placeholder="Leave blank to dont change">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>SMTP Sender Email</label>
                                            <input type="text" class="form-control" name="smtp_sender" value="<?php echo SMTP_SENDER; ?>" placeholder="SMTP sender email" required>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php require_once '_footer.php'; ?>