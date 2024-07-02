<?php

    class Admin {
        private $select;

        function __construct($select) {
            $this->select = $select;
        }

        function displayAdminProducts() {
            $result = $this->select->selectAllVariations();
        
            while($row = $result->fetch_assoc()) {
                echo '
                    <div class="product-card">
                        <img src="../assets/' . $row['VariationImage'] . '" class="product-card--images">
                        <h2 class="product-card--text">' . $row['VariationName'] . '</h2>
                    </div>
                ';
            }
        }

        function displayChart($result, $name, $value) {
            echo '
                <canvas id="' . $name .'"></canvas>
            ';

            echo '
            <script>
                const xValues = [];
                const yValues = [];
                ';
    
                $i = 0;
    
            while ($row = $result->fetch_assoc()) {
                if ($i >= 5) break;
                echo '
                    xValues.push("' . $row[$name]  . '");
                    yValues.push(' . $row[$value] . ');
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

            new Chart(document.getElementById("' . $name . '"), {
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
    }

?>