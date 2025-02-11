<?php $this->load->view('inc/top'); ?>

<body>
    <div class="body-wrapper">
        <?php $this->load->view('inc/sidebar'); ?>
        <div class="main-wrapper mdc-drawer-app-content">
            <?php $this->load->view('inc/navbar'); ?>

            <div class="page-wrapper mdc-toolbar-fixed-adjust">
                <main class="content-wrapper">
                    <div class="col-lg-12 p-4">
                        <div class="card border-0">
                            <form class="mdc-card p-4" action="<?php echo base_url('Hospital/addPatientHistory'); ?>" method="post">
                                <h3 class="mb-4" style="color: #4b3a6e;">Medical History for Patient #<?php echo $patient_id; ?></h3>
                                <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
                                <div class="template-demo">
                                    <div class="mdc-layout-grid__inner">

                                        <!-- Condition -->
                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                            <div class="mdc-text-field mdc-text-field--outlined">
                                                <input class="mdc-text-field__input" id="condition" name="condition" required>
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label for="condition" class="mdc-floating-label">Disease</label>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Diagnosis Date -->
                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                            <div class="mdc-text-field mdc-text-field--outlined">
                                                <input class="mdc-text-field__input" id="diagnosis_date" name="diagnosis_date" type="date" required>
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label for="diagnosis_date" class="mdc-floating-label">Diagnosis Date</label>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Treatment -->
                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                            <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--textarea">
                                                <textarea class="mdc-text-field__input" id="treatment" name="treatment" required></textarea>
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label for="treatment" class="mdc-floating-label">Treatment</label>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Medications -->
                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                            <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--textarea">
                                                <textarea class="mdc-text-field__input" id="medications" name="medications" required></textarea>
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label for="medications" class="mdc-floating-label">Medications</label>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Notes -->
                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
                                            <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--textarea">
                                                <textarea class="mdc-text-field__input" id="notes" name="notes" required></textarea>
                                                <div class="mdc-notched-outline">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                        <label for="notes" class="mdc-floating-label">Notes</label>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="mdc-button mdc-button--raised mdc-ripple-upgraded mt-4" type="submit">Add History</button>
                            </form>
                        </div>

                        <!-- Space between form and history records table -->
                        <div class="mt-5"></div>

                        <div class="card border-0 mt-4">
                            <div class="card-header border-bottom">
                                <h3 class="h4 mb-0" style="color: #2a1c5a;">History Records</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    
                                    <table class="table table-striped table-bordered text-center">
                                        <thead class="text-capitalize">
                                            <tr>
                                                <th>Disease</th>
                                                <th>Diagnosis Date</th>
                                                <th>Treatment</th>
                                                <th>Medications</th>
                                                <th>Notes</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($medical_history)): ?>
                                                <?php foreach ($medical_history as $history): ?>
                                                    <tr>
                                                        <td><?php echo $history->condition; ?></td>
                                                        <td><?php echo $history->diagnosis_date; ?></td>
                                                        <td><?php echo $history->treatment; ?></td>
                                                        <td><?php echo $history->medications; ?></td>
                                                        <td><?php echo $history->notes; ?></td>
                                                        <td>
                                                            <a href="<?php echo base_url('Hospital/deletePatientHistory/' . $history->id . '/' . $patient_id); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No medical history found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <?php $this->load->view('inc/footer'); ?>
            </div>
        </div>
    </div>

    <?php $this->load->view('inc/bottom'); ?>
</body>

</html>