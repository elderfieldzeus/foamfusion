<?php
    function displayChart($result, $name, $value) {
        echo '
            <canvas id="chart" width="50%" height="100%"></canvas>
        ';
        echo '
        <script>
            const xValues = [];
            const yValues = [];
            ';

            $i = 0;

            while($row = $result->fetch_assoc() && $i < 5) {
                echo '
                    xValues.push("' . $row[$name]  . '");
                    yValues.push("' . $row[$value] . '");
                ';
                $i++;
            }

            echo '
            const barColors = [
            "#b91d47",
            "#00aba9",
            "#2b5797",
            "#e8c3b9",
            "#1e7145"
            ];

            new Chart("chart", {
                type: "pie",
                data: {
                    labels: xValues,
                    datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                    }]
                }
            });
        </script>
        ';
    }

?>