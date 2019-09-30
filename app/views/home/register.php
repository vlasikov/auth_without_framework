<div class="container">
    <div class="row justify-content-center" id="register">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?=$dictRegister?></div>

                <div class="card-body">
                    <form method="POST" action="register" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"><?=$dictName?></label>

                            <div class="col-md-6">
                                    <?php if (isset($data['old']['name'])) { ?>
                                        <input id="name" type="text" class="form-control" name="name" value="<?=$data['old']['name']?>" required autofocus>
                                    <?php }else{ ?>
                                        <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                                    <?php } ?>
                                <?php if (isset($data['errors']['name'])) {?>
                                    <span  role="alert">
                                        <strong><?=$data['errors']['name'] ?></strong>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><?=$dictEmailAddress?></label>

                            <div class="col-md-6">
                                <?php if (isset($data['old']['email'])) {?>
                                    <input id="email" type="email" class="form-control" name="email" value="<?=$data['old']['email']?>" required>
                                <?php }else{ ?>
                                    <input id="email" type="email" class="form-control" name="email" value="" required>
                                <?php } ?>
                                <?php if (isset($data['errors']['email'])) {?>
                                    <span  role="alert">
                                        <strong><?=$data['errors']['email'] ?></strong>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><?=$dictPassword?></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                <?php if (isset($data['errors']['password'])) {?>
                                    <span  role="alert">
                                        <strong><?=$data['errors']['password'] ?></strong>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><?=$dictConfirmPassword?></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><?=$dictImage?></label>

                            <div class="col-md-6">
                                <input type="file" name="uploaded_file" id="uploaded_file" accept="image/jpeg,image/jpg,image/png,image/gif" required>
                                <?php if (isset($data['errors']['file'])) {?>
                                    <span  role="alert">
                                        <strong><?=$data['errors']['file'] ?></strong>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?=$dictRegister?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>