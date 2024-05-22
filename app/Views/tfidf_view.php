<!DOCTYPE html>
<html>
<head>
    <title>TF-IDF Results</title>
</head>
<body>
    <h1>TF-IDF Results</h1>

    <!-- Form Pencarian -->
    <form action="<?= base_url('tfidf/search') ?>" method="get">
        <label for="keyword">Keyword:</label>
        <input type="text" id="keyword" name="keyword">
        <button type="submit">Search</button>
    </form>

    <!-- Hasil Pencarian -->
    <?php if (!empty($tfidfMatrix)): ?>
        <?php if (isset($keyword)): ?>
            <h2>Search Results for: <?= $keyword ?></h2>
        <?php endif; ?>
        <?php foreach ($tfidfMatrix as $docId => $words): ?>
            <h2>Document ID: <?= $docId ?></h2>
            <ul>
                <?php foreach ($words as $word => $score): ?>
                    <li><?= $word ?>: <?= $score ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
