<div class="main-body">
    <div class="row">
        <!-- Divider Line -->
        <div class="col-md-12 text-center ">
            <hr class="border-2 border-secondary opacity-50 mb-3">
            <h4 class="fw-bold text-dark"><i class="bx bx-group"></i> আমাদের নেতৃত্ব / Leader Section</h4>
        </div>

        <!-- Add Leader Card -->
        <div class="col-md-12 mb-5">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient bg-primary text-white rounded-top-4">
                    <h4 class="mb-0"><i class="bx bx-user-plus"></i> নতুন নেতা যোগ করুন</h4>
                </div>
                <div class="card-body bg-light">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <!-- No backend, dummy form -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label fw-bold">নাম / Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg shadow-sm" id="name" name="name" placeholder="নেতার নাম লিখুন" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="designation" class="form-label fw-bold">পদবী / Designation <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg shadow-sm" id="designation" name="designation" placeholder="পদবী লিখুন" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="photo" class="form-label fw-bold">ফটো / Photo <span class="text-danger">*</span></label>
                                <input type="file" class="form-control form-control-lg shadow-sm" id="photo" name="photo" accept="image/*" required>
                            </div>
                        </div>

                        <div class="text-center my-3">
                            <img id="photoPreview" src="" alt="Preview" class="img-thumbnail shadow-sm rounded-3" style="max-width: 150px; display: none;">
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-success btn-lg shadow">
                                <i class="bx bx-plus-circle"></i> নেতা যোগ করুন
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
        <!-- Leaders List -->
        <div class="col-md-12">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient bg-info text-white rounded-top-4">
                    <h4 class="mb-0"><i class="bx bx-list-ul"></i> নেতৃত্ব তালিকা</h4>
                </div>
                <div class="card-body bg-light">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle rounded-3 shadow-sm mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th width="15%">ফটো</th>
                                    <th width="25%">নাম</th>
                                    <th width="25%">পদবী</th>
                                    <th width="15%" class="text-center">অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dummy Data -->
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>
                                        <img src="https://via.placeholder.com/80" alt="Leader 1" class="rounded-circle border border-2 shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                                    </td>
                                    <td class="fw-bold">মোঃ রফিকুল ইসলাম</td>
                                    <td>সভাপতি</td>
                                    <td class="text-center">
                                        <button class="btn btn-danger btn-sm rounded-pill shadow-sm">
                                            <i class="bx bx-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>
                                        <img src="https://via.placeholder.com/80" alt="Leader 2" class="rounded-circle border border-2 shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                                    </td>
                                    <td class="fw-bold">মোঃ কামরুল হাসান</td>
                                    <td>সহ-সভাপতি</td>
                                    <td class="text-center">
                                        <button class="btn btn-danger btn-sm rounded-pill shadow-sm">
                                            <i class="bx bx-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>
                                        <img src="https://via.placeholder.com/80" alt="Leader 3" class="rounded-circle border border-2 shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                                    </td>
                                    <td class="fw-bold">মোঃ সাইফুল ইসলাম</td>
                                    <td>সাধারণ সম্পাদক</td>
                                    <td class="text-center">
                                        <button class="btn btn-danger btn-sm rounded-pill shadow-sm">
                                            <i class="bx bx-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Simple JS for Image Preview -->
<script>
    document.getElementById('photo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('photoPreview');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    });
</script>
