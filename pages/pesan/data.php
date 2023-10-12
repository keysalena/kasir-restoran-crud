<head>
  <script src="script.js"></script>
</head>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>DATA PESANAN</h6>
          <?php require_once 'pesan/kantong.php'; ?>
        </div>
        <div class="card-body px-6 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0 custom-table" id="masakan">
            <thead>
              <tr>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID MASAKAN</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA MASAKAN</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">HARGA</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PEMBELIAN</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
                <?php
                include "../conf/conn.php";
                $no = 0;
                $query = mysqli_query($koneksi, "SELECT * FROM masakan ORDER BY id_masakan
DESC");
                while ($row = mysqli_fetch_array($query)) {
                ?>
                  <tr>
                    <form method="POST" action="index.php?page=data_pesan">
                      <input type="hidden" name="id_masakan" value="<?= $row['id_masakan']; ?>"></input>
                      <td class="align-middle text-center text-sm"><?php echo $no = $no + 1; ?></td>
                      <td class="align-middle text-center text-sm"><?php echo $row['id_masakan']; ?></td>
                      <td class="align-middle text-center text-sm"><?php echo $row['nama_masakan']; ?></td>
                      <td class="align-middle text-center text-sm"><?php echo $row['harga']; ?></td>
                      <td>
                        <input class="form-control" type="number" name="pembelian" value="1" min="1">
                      </td>
                      <td>
                        <button class="btn btn-primary" type="submit" name="submit">
                          <i class="fa fa-shopping-cart"></i>
                        </button>
                      </td>
                  </tr>
                </form>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </tr>
                  <?php } ?>
                <script>
                  $(document).ready(function() {
                    $('#masakan').DataTable({
                      "pagingType": "full_numbers", // Add pagination
                      "lengthMenu": [10, 25, 50, 75, 100], // Items per page options
                      "processing": true, // Show processing indicator
                      "searching": true, // Enable search
                      "ordering": true, // Enable ordering
                      "info": true, // Show table information
                      "autoWidth": true, // Disable auto-width
                      "responsive": true, // Enable responsive design
                      "language": {
                        "search": "_INPUT_", // Search input customization
                        "searchPlaceholder": "Search masakan", // Search input placeholder
                      }
                    });
                  });
                </script>