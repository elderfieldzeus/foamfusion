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
            <script>
                const xValues_' . $name . ' = [];
                const yValues_' . $name . ' = [];
                const barColors_' . $name . ' = [];

                function randomColor() {
                    const letters = "0123456789ABCDEF";
                    let color = "#";
                    for (let i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }
                ';
    
                $i = 0;
    
            while ($row = $result->fetch_assoc()) {
                if ($i >= 5) break;
                echo '
                    xValues_' . $name . '.push("' . $row[$name]  . '");
                    yValues_' . $name . '.push(' . $row[$value] . ');
                    barColors_' . $name . '.push(randomColor());
                ';
                $i++;
            }
    
            echo '
            

            new Chart(document.getElementById("' . $name . '"), {
                type: "doughnut",
                data: {
                    labels: xValues_' . $name . ',
                    datasets: [{
                        backgroundColor: barColors_' . $name . ',
                        data: yValues_' . $name . '
                    }]
                }
            });
            </script>
            ';
        }
    }

?>