<body class="bg-gradient-warning" style="background-image: url('https://img.freepik.com/free-photo/top-view-back-school-stationery-with-colorful-pencils-copy-space_23-2148587576.jpg');">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">

                    <!-- Flash data error -->
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                            <?php echo $this->session->flashdata('error'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Form Registration</h1>
                                    </div>
                                    <form class="user" method="post" action="<?= base_url('administrator/auth/registration') ?>">
                                        <div class="form-group">
                                        <span class="badge badge-custom">Email</span>
                                            <input type="email" class="form-control "
                                                id="email" name="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." value="<?= set_value('email') ?>">

                                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>
                                        <div class="form-group">
                                        <span class="badge badge-custom">Password</span>
                                            <input type="password" class="form-control"
                                                id="password" name="password" placeholder="Enter Password">

                                                <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>
                                        <div class="form-group">
                                        <span class="badge badge-custom">Username</span>
                                            <input type="text" class="form-control "
                                                id="username" name="username"
                                                placeholder="Enter username" value="<?= set_value('username') ?>">

                                                <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>
                                        <div class="form-group">
                                        <span class="badge badge-custom">Full name</span>
                                            <input type="text" class="form-control "
                                                id="full_name" name="full_name"
                                                placeholder="Enter full name" value="<?= set_value('full_name') ?>">

                                                <?= form_error('full_name', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>
                                        <div class="form-group">
                                        <span class="badge badge-custom">Level user</span>
                                            <select class="form-control" id="level_id" name="level_id" value="<?= set_value('level_id') ?>">
                                                <option value="" disabled selected>Select an option</option>
                                                <option value="1" <?= set_value('level_id') == '1' ? 'selected' : '' ?>>User</option>
                                                <option value="2" <?= set_value('level_id') == '2' ? 'selected' : '' ?>>Admin</option>
                                            </select>

                                                <?= form_error('level_id', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>

                                        
                                        <button type="submit" class="btn btn-danger btn-block">
                                            Registration
                                        </button>
                                        <hr>
                                        
                                    <div class="text-center">
                                        <a class="large text-danger" href="<?= base_url('/administrator/auth') ?>">Already have an account?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
