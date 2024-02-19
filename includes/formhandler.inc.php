<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["query"]) && strlen($_GET["query"]) >= 2) {
        $value_to_find = sanitizer(); // filter user input

        $user = ; // add your db username
        $password = ; //add your db username password

        try {  //database main logic
            $pdo = new PDO(
                'mysql:host=;port=;dbname=', //add your MySql server host, port and name of your database
                $user,
                $password
            );
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("
            SELECT DISTINCT * FROM (
                (
                SELECT 
                    relics_tier,
                    relics_relicName,
                    relics_state,
                    relics_rewards_0_itemName AS reward_slot,
		            relics_rewards_0_rarity as item_rarity,
                    relics_rewards_0_chance AS drop_chance
                FROM 
                    relics
                WHERE 
                   LOWER(relics_rewards_0_itemName) LIKE LOWER(?)
                )

                UNION ALL

                (
                SELECT 
                    relics_tier,
                    relics_relicName,
                    relics_state,
                    relics_rewards_1_itemName AS reward_slot,
		            relics_rewards_1_rarity as item_rarity,
                    relics_rewards_1_chance AS drop_chance
                FROM 
                    relics
                WHERE 
                    LOWER(relics_rewards_1_itemName) LIKE LOWER(?)
                )

                UNION ALL

                (
                SELECT 
                    relics_tier,
                    relics_relicName,
                    relics_state,
                    relics_rewards_2_itemName AS reward_slot,
		            relics_rewards_2_rarity as item_rarity,
                    relics_rewards_2_chance AS drop_chance
                FROM 
                    relics
                WHERE 
                    LOWER(relics_rewards_2_itemName) LIKE LOWER(?)
                )

                UNION ALL

                (
                SELECT 
                    relics_tier,
                    relics_relicName,
                    relics_state,
                    relics_rewards_3_itemName AS reward_slot,
		            relics_rewards_3_rarity as item_rarity,
                    relics_rewards_3_chance AS drop_chance
                FROM 
                    relics
                WHERE 
                    LOWER(relics_rewards_3_itemName) LIKE LOWER(?)
                )

                UNION ALL

                (
                SELECT 
                    relics_tier,
                    relics_relicName,
                    relics_state,
                    relics_rewards_4_itemName AS reward_slot,
		            relics_rewards_4_rarity as item_rarity,
                    relics_rewards_4_chance AS drop_chance
                FROM 
                    relics
                WHERE 
                    LOWER(relics_rewards_4_itemName) LIKE LOWER(?)
                )

                UNION ALL

                (
                SELECT 
                    relics_tier,
                    relics_relicName,
                    relics_state,
                    relics_rewards_5_itemName AS reward_slot,
		            relics_rewards_5_rarity as item_rarity,
                    relics_rewards_5_chance AS drop_chance
                FROM 
                    relics
                WHERE 
                    LOWER(relics_rewards_5_itemName) LIKE LOWER(?)

                )) AS subquery
                ORDER BY 
                    drop_chance DESC
            "); // I probably could made a better query ;-;

            $value_to_find = '%' . $value_to_find . '%';

            $stmt->bindParam(1, $value_to_find, PDO::PARAM_STR);
            $stmt->bindParam(2, $value_to_find, PDO::PARAM_STR);
            $stmt->bindParam(3, $value_to_find, PDO::PARAM_STR);
            $stmt->bindParam(4, $value_to_find, PDO::PARAM_STR);
            $stmt->bindParam(5, $value_to_find, PDO::PARAM_STR);
            $stmt->bindParam(6, $value_to_find, PDO::PARAM_STR);

            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count > 0) {
                echo <<<GFG
                <table class="content-table">
                    <thead>
                        <tr>
                        <th>Item</th>
                        <th>Relic</th>
                        <th>Drop Chance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows for data will go here -->
                GFG;

                $results = $stmt->fetchAll();
                foreach ($results as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['reward_slot'] . "</td>";
                    echo "<td>" . $row['relics_tier'] . " {$row['relics_relicName']}" . ", {$row['relics_state']}" . "</td>";
                    echo "<td>" . $row['item_rarity']. " ({$row['drop_chance']}%)" . "</td>";
                    echo "</tr>";
                }

                echo<<<GFG
                    </tbody>
                </table>
                GFG;
            } else {
                echo "
                    <p class=\"empty-field\">
                    No matches found. Try refining your search terms or exploring other options.
                    </p>";
            }
        } catch (PDOException $e) {
            echo "<p class=\"empty-field\">
                 Our database connection failed. We are sorry ;-;
                 </p>";
        }
    } else {
        echo "
        <p class=\"empty-field\">
        It seems like your input is too short. Please enter at least 2 characters.
        </p>";
    }
} else {
    echo "NOOO";
}

function sanitizer()
{
    $input = $_GET["query"];
    $filtered_input = htmlspecialchars($input);
    return $filtered_input;
}
