<script>
    const xValues_<?= $name ?> = [];
    const yValues_<?= $name ?> = [];
    const barColors_<?= $name ?> = [];

    function randomColor() {
        const letters = "0123456789ABCDEF";
        let color = "#";
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    <?php
        $i = 0;

        while ($row = $result->fetch_assoc()): ?>
            <?php if ($i >= 3) break; ?>
                xValues_<?= $name ?>.push("<?= $row[$name]  ?>");
                yValues_<?= $name ?>.push(<?= $row[$value] ?>);
                barColors_<?= $name ?>.push(randomColor());
            <?php $i++; ?>
        
    <?php endwhile; ?>

    new Chart(document.getElementById("<?= $name ?>"), {
        type: "doughnut",
        data: {
            labels: xValues_<?= $name ?>,
            datasets: [{
                backgroundColor: barColors_<?= $name ?>,
                data: yValues_<?= $name ?>
            }]
        }
    });
</script>