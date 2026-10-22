<label><?= e(t('nim')) ?></label>
<input type="text" name="nim" value="<?= e($val['nim']) ?>">

<label><?= e(t('name')) ?></label>
<input type="text" name="nama" value="<?= e($val['nama']) ?>">

<label><?= e(t('email')) ?></label>
<input type="text" name="email" value="<?= e($val['email']) ?>">

<label><?= e(t('major')) ?></label>
<select name="jurusan">
  <option value=""><?= e(t('choose_major')) ?></option>
  <?php foreach ($daftar_jurusan as $j): ?>
    <option value="<?= e($j) ?>" <?php if ($val['jurusan'] == $j) { echo 'selected'; } ?>><?= e($j) ?></option>
  <?php endforeach; ?>
</select>

<label><?= e(t('year')) ?></label>
<input type="text" name="angkatan" value="<?= e($val['angkatan']) ?>">
