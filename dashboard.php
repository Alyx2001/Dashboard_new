<?php
session_start(); 

$user_role = $_SESSION['user_role'];

if(!isset($_SESSION['user_role'])) {
    header('location: /laundry_system/homepage/homepage.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"/>
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <!---CHART--->
    <script src ="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <!-- Bootstrap 5 JS (required for modal functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="progress"></div>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button id="toggle-btn" type="button">
                    <i class="bx bx-menu-alt-left"></i>
                </button>

                <div class="sidebar-logo">
                    <a href="#">Azia Skye</a>
                </div>
            </div>

            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="/laundry_system/dashboard/dashboard.php" class="sidebar-link">
                        <i class="lni lni-grid-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="/laundry_system/profile/profile.php" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Profile</span>
                    </a>
                </li>

                <?php if ($user_role === 'admin') : ?>
                    <li class="sidebar-item">
                        <a href="/laundry_system/users/users.php" class="sidebar-link">
                            <i class="lni lni-users"></i>
                            <span>Users</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse"
                            data-bs-target="#records" aria-expanded="false" aria-controls="records">
                            <i class="lni lni-files"></i>
                            <span>Records</span>
                        </a>

                        <ul id="records" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="/laundry_system/records/customer.php" class="sidebar-link">Customer</a>
                            </li>

                            <li class="sidebar-item">
                                <a href="/laundry_system/records/service.php" class="sidebar-link">Service</a>
                            </li>

                            <li class="sidebar-item">
                                <a href="/laundry_system/records/category.php" class="sidebar-link">Category</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="sidebar-item">
                    <a href="/laundry_system/transaction/transaction.php" class="sidebar-link">
                        <i class="lni lni-coin"></i>
                        <span>Transaction</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="/laundry_system/sales_report/report.php" class="sidebar-link">
                        <i class='bx bx-line-chart'></i>
                        <span>Sales Report</span>
                    </a>
                </li>

                    <?php if ($user_role === 'admin') : ?>
                    <li class="sidebar-item">
                        <a href="/laundry_system/settings/setting.php" class="sidebar-link">
                            <i class="lni lni-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>

                    <hr style="border: 1px solid #b8c1ec; margin: 8px">

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse"
                        data-bs-target="#archived" aria-expanded="false" aria-controls="archived">
                            <i class='bx bxs-archive-in'></i>
                            <span>Archived</span>
                        </a>

                        <ul id="archived" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="/laundry_system/archived/archive_users.php" class="sidebar-link">Archived Users</a>
                            </li>

                            <li class="sidebar-item">
                                <a href="/laundry_system/archived/archive_customer.php" class="sidebar-link">Archived Customer</a>
                            </li>

                            <li class="sidebar-item">
                                <a href="/laundry_system/archived/archive_service.php" class="sidebar-link">Archived Service</a>
                            </li>

                            <li class="sidebar-item">
                                <a href="/laundry_system/archived/archive_category.php" class="sidebar-link">Archived Category</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

            </ul>

            <div class="sidebar-footer">
                <a href="#" id="btn_logout" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        
        <!-------------MAIN CONTENT------------->
        <div class="main-content">
            <nav>
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Dashboard</h1>
                </div>
            </nav>
            <div class="cards"><!--Card for Delivery, Pick-Up-->
                
            <?php
            $servername = "localhost"; 
            $username = "root";         
            $password = "";            
            $dbname = "laundry_db";  

            // Database connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Database connection failed: " . $conn->connect_error);
            }

            
            // Delivery Requests Query 
            $pickup_sql = "SELECT sr.customer_name, sr.customer_id,
                                  SUM(sr.weight) AS total_weight, 
                                  SUM(sr.quantity) AS total_quantity, 
                                  sr.request_date, sr.service_req_time, sr.remarks, tr.customer_address, tr.brgy , tr.total_amount
                            FROM service_request sr
                            JOIN transaction tr ON sr.request_id = tr.request_id
                            WHERE sr.remarks IN ('Unclaimed', 'Pending')
                                AND tr.service_option_name = 'Customer Pick-Up'
                                AND sr.request_date <= CURRENT_TIMESTAMP
                            GROUP BY sr.customer_name, sr.customer_id, sr.request_date, sr.remarks, tr.customer_address,tr.brgy , tr.total_amount
                            ORDER BY sr.request_date DESC"; 

            // Delivery Requests Query 
            $delivery_sql = "SELECT sr.customer_name, sr.customer_id,
                                SUM(sr.weight) AS total_weight, 
                                SUM(sr.quantity) AS total_quantity, 
                                sr.request_date, sr.service_req_time, sr.remarks, tr.customer_address, tr.brgy , tr.total_amount
                            FROM service_request sr
                            JOIN transaction tr ON sr.request_id = tr.request_id
                            WHERE sr.remarks IN ('Undelivered', 'Pending') 
                                AND tr.service_option_name = 'Delivery'
                                AND sr.request_date <= CURRENT_DATE
                            GROUP BY sr.customer_name, sr.customer_id
                            ORDER BY sr.request_date DESC"; 

            // Rush Request Query 
            $rush_sql = "SELECT sr.customer_name, sr.customer_id, 
                            SUM(DISTINCT sr.weight) AS total_weight, 
                            SUM(DISTINCT sr.quantity) AS total_quantity, 
                            sr.request_date, sr.service_req_time, sr.remarks, tr.customer_address, tr.brgy ,tr.total_amount
                        FROM service_request sr
                        JOIN transaction tr ON sr.customer_id = tr.customer_id
                        WHERE sr.remarks IN ('Undelivered', 'Unclaimed', 'Pending')
                            AND tr.laundry_cycle = 'Rush'
                            AND sr.request_date <= CURRENT_DATE
                        GROUP BY sr.customer_name, sr.customer_id, sr.request_date, sr.remarks, tr.customer_address, tr.brgy , tr.total_amount
                        ORDER BY sr.request_date DESC"; 

            // queries
            $pickup_result = $conn->query($pickup_sql);
            $delivery_result = $conn->query($delivery_sql);
            $rush_result = $conn->query($rush_sql);

            // Check for SQL errors 
            if (!$pickup_result) {
                die("Error executing pickup SQL query: " . $conn->error);
            }

            if (!$delivery_result) {
                die("Error executing delivery SQL query: " . $conn->error);
            }

            if (!$rush_result){
                die("Error executing delivery SQL query: " . $conn->error); 
            }

            // Get counts
            $pickup_count = $pickup_result->num_rows;
            $delivery_count = $delivery_result->num_rows;
            $rush_count = $rush_result->num_rows;

            ?>

            <!-- Pickup Requests Card -->
            <div class="card card-body p-3 mb-3">
                <div class="header-container">
                    <h4>Customer Pick-Up</h4>
                    <button class="btn-notify" data-bs-toggle="modal" data-bs-target="#pickupModal">
                        <i class="bi bi-bell"></i>🔔
                    </button>
                </div>

                <h5 id="pickup-orders">
                    <?php echo $pickup_count; ?> 
                </h5>
            </div>

            <!-- Pickup Notification Modal -->
            <div class="modal fade" id="pickupModal" tabindex="-1" aria-labelledby="pickupModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pickupModalLabel">Pickup Requests</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php while($row = $pickup_result->fetch_assoc()): ?>
                                <div class="notification-item">
                                <p><h4><strong><?php echo $row['customer_name']; ?></strong></h4></p>
                                    <p>Address: <?php echo $row['customer_address'].'  '.' , '. $row['brgy']; ?></p>
                                    <p>Weight: <?php echo $row['total_weight']; ?>kg</p>
                                    <p>Quantity: <?php echo $row['total_quantity']; ?></p>
                                    <p>Request Date: <?php echo $row['request_date'].'  '.' at '. $row['service_req_time'] ?>
                                    <p>Total Amount: <?php echo $row['total_amount']; ?></p>
                                    
                                    <!-- Checkboxes for Remarks -->
                                    <input type="checkbox" class="pickup-checkbox" data-id="<?php echo $row['customer_id']; ?>" data-remark="Claimed"> Claimed
                                    <input type="checkbox" class="pickup-checkbox" data-id="<?php echo $row['customer_id']; ?>" data-remark="Unclaimed"> Unclaimed
                                    <input type="checkbox" class="pickup-checkbox" data-id="<?php echo $row['customer_id']; ?>" data-remark="Pending"> Pending
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delivery Requests Card -->
            <div class="card card-body p-3 mb-3">
                <div class="header-container">
                    <h4>Delivery Requests</h4>
                    <button class="btn-outline" data-bs-toggle="modal" data-bs-target="#deliveryModal">
                        <i class="bi bi-bell"></i> 🔔
                    </button>
                </div>
                <h5 id="delivery-orders">
                    <?php echo $delivery_count; ?> 
                </h5>
            </div>

            <!-- Delivery Notification Modal -->
            <div class="modal fade" id="deliveryModal" tabindex="-1" aria-labelledby="deliveryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deliveryModalLabel">Delivery Requests</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php while($row = $delivery_result->fetch_assoc()): ?>
                                <div class="notification-item">
                                <p><h4><strong><?php echo $row['customer_name']; ?></strong></h4></p>
                                    <p>Address: <?php echo $row['customer_address'].'  '.' , '. $row['brgy']; ?></p>
                                    <p>Weight: <?php echo $row['total_weight']; ?>kg</p>
                                    <p>Quantity: <?php echo $row['total_quantity']; ?></p>
                                    <p>Request Date: <?php echo $row['request_date'].'  '.' at '. $row['service_req_time'] ?>
                                    <p>Total Amount: <?php echo $row['total_amount']; ?></p>
                                    
                                    
                                    <!-- Checkboxes for Remarks -->
                                    <input type="checkbox" class="delivery-checkbox" data-id="<?php echo $row['customer_id']; ?>" data-remark="Delivered"> Delivered
                                    <input type="checkbox" class="delivery-checkbox" data-id="<?php echo $row['customer_id']; ?>" data-remark="Undelivered"> Undelivered
                                    <input type="checkbox" class="delivery-checkbox" data-id="<?php echo $row['customer_id']; ?>" data-remark="Pending"> Pending
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!--Rush-->

            <!-- Rush Requests Card -->
            <div class="card card-body p-3 mb-3">
                <div class="header-container">
                    <h4>Rush Requests</h4>
                    <button class="btn-hamberger" data-bs-toggle="modal" data-bs-target="#rushModal">
                        <i class="fas fa-bars" style="font-size: 19px"></i> 
                    </button>
                </div>
                <h5 id="rush-orders">
                    <?php echo $rush_count; ?> <!-- Active Delivery Requests -->
                </h5>
            </div>

            <!-- Rush Notification Modal -->
            <div class="modal fade" id="rushModal" tabindex="-1" aria-labelledby="rushModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="rushModalLabel"> Requests</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php while($row = $rush_result->fetch_assoc()): ?>
                                <div class="notification-item">
                                <p><h4><strong><?php echo $row['customer_name']; ?></strong></h4></p>
                                    <p>Address: <?php echo $row['customer_address'].'  '.' , '. $row['brgy']; ?></p>
                                    <p>Weight: <?php echo $row['total_weight']; ?>kg</p>
                                    <p>Quantity: <?php echo $row['total_quantity']; ?></p>
                                    <p>Request Date: <?php echo $row['request_date'].'  '.' at '. $row['service_req_time'] ?>
                                    <p>Total Amount: <?php echo $row['total_amount']; ?></p>
                                    
                                    <!-- Checkboxes for Remarks -->
                                <!--   <input type="checkbox" class="delivery-checkbox" data-id="<php echo $row['customer_id']; ?>" data-remark="Delivered"> Delivered
                                    <input type="checkbox" class="delivery-checkbox" data-id="<php echo $row['customer_id']; ?>" data-remark="Undelivered"> Undelivered
                                    <input type="checkbox" class="delivery-checkbox" data-id="<php echo $row['customer_id']; ?>" data-remark="Pending"> Pending-->
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
            </div><!--End of Card :)-->
             
               

                <!------------------CHARTS----------------------->
                <div class="charts-container">
                    <div class="charts">
                        <!--ORDERS IN DAY-->
                        <div class="chart" id="weeklyChart">
                            <h4>Service Requests in Day</h4>
                            <canvas id="daychart"></canvas>
                            <div id="chart_dialog" title="View Chart"></div>
                        </div>
                        
                        <!-----ORDERS IN WEEK-->          
                        <div class="chart" id="weeklyChart">
                            <h4>Service Requests in Week</h4>
                            <canvas id="weekchart"></canvas> 
                        </div>
                        <!--ORDERS IN MONTH--->
                        <div class="chart" id="monthlyChart">
                            <h4>Service Requests in Month</h4>
                            <canvas id="monthchart"></canvas>
                        </div>

                        <!--YEAR CHART-->
                        <div class="chart" id="yearlyChart" >
                            <h4>Service Requests in Year</h4>
                            <canvas id="yearchart"></canvas>
                        </div>
                    </div> <!--end of charts-->   
                </div> <!--end of charts-container-->
                
            <!--------------CALENDAR------------------->
            <div class="container">
                    <div class="left">
                        <div class="calendar">
                            <div class="month">
                                <i class="fas fa-angle-left prev"></i>
                                <div class="date">December 2015</div>
                                <i class="fas fa-angle-right next"></i>
                            </div>
                            <div class="weekdays">
                                <div>Sun</div>
                                <div>Mon</div>
                                <div>Tue</div>
                                <div>Wed</div>
                                <div>Thu</div>
                                <div>Fri</div>
                                <div>Sat</div>
                            </div>
                            <div class="days"></div>

                            <div class="container-sm">
                                <div class="legend-container">
                                    <div class="legend-item">
                                        <i class='bx bxs-circle' style='color:#0758ff'></i>
                                        <span>Past Requests</span>
                                    </div>

                                    <div class="legend-item">
                                        <i class='bx bxs-circle' style='color:#ff0707'></i>
                                        <span>Upcoming Requests</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="right">
                        <div class="event-title">Requests</div>
                        <div class="events"></div>
                    </div>

                    <?php
                        $conn = new mysqli('localhost', 'root', '', 'laundry_db');

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $query = "SELECT sr.request_id, sr.laundry_service_option, sr.request_date, sr.service_request_date, sr.customer_name , t.service_option_name, t.laundry_cycle
                                FROM service_request sr 
                                INNER JOIN transaction t ON sr.request_id = t.request_id 
                                WHERE sr.order_status = 'completed'";
                        $result = $conn->query($query);

                        if (!$result) {
                            die("Query failed: " . $conn->error);
                        }
                
                    $events = array();

                    while ($row = $result->fetch_assoc()) {
                        $events[] = array(
                            'title' => $row['laundry_service_option'],
                            'customer_name' => $row['customer_name'],
                            'service_option_name' => $row['service_option_name'],
                            'laundry_cycle' => $row['laundry_cycle'],
                            'start' => $row['service_request_date'],
                            'end' => $row['request_date'],
                        );
                    }

                    //close connection
                    $conn->close();
                    ?>

                    <script>

                        const calendar = document.querySelector(".calendar"),
                            date = document.querySelector(".date"),
                            daysContainer = document.querySelector(".days"),
                            prev = document.querySelector(".prev"),
                            next = document.querySelector(".next");

                        let today = new Date();
                        let activeDay;
                        let month = today.getMonth();
                        let year = today.getFullYear();

                        const months = [
                            "January",
                            "February",
                            "March",
                            "April",
                            "May",
                            "June",
                            "July",
                            "August",
                            "September",
                            "October",
                            "November",
                            "December",
                        ];

                        //highlight the clicked day(s) in calendar
                        daysContainer.addEventListener('click', function(event) {
                            if (event.target.classList.contains('day')) {
                                const allDays = daysContainer.querySelectorAll('.day');
                                allDays.forEach(function(day) {
                                    day.classList.remove('clicked');
                                });
                                event.target.classList.add('clicked');
                            }
                        });
                        
                        function initCalendar() {
                            const firstDay = new Date(year, month, 1);
                            const lastDay = new Date(year, month + 1, 0);
                            const prevLastDay = new Date(year, month, 0);
                            const prevDays = prevLastDay.getDate();
                            const lastDate = lastDay.getDate();
                            const day = firstDay.getDay();
                            const nextDays = 7 - lastDay.getDay() - 1;

                            date.innerHTML = months[month] + " " + year;

                            //to reset today to midnight for date-only comparisons
                            const today = new Date();
                            today.setHours(0, 0, 0, 0);

                            let days = "";
                            // Prev
                            for (let x = day; x > 0; x--) {
                                days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
                            }

                            for (let i = 1; i <= lastDate; i++) {
                                const eventDate = new Date(year, month, i);
                                const eventsForDay = <?php echo json_encode($events); ?>.filter((event) => {
                                    const eventEnd = new Date(event.end);
                                    return (
                                        eventEnd.getDate() === i &&
                                        eventEnd.getMonth() === month &&
                                        eventEnd.getFullYear() === year
                                    );
                                });

                                if (eventsForDay.length > 0) {
                                    if (eventDate < today) {
                                        console.log(`Applying past-event to day ${i}`);
                                        days += `<div class="day has-event past-event mark">${i}</div>`;
                                    } else {
                                        days += `<div class="day has-event mark">${i}</div>`;
                                    }
                                } else if (
                                    i === today.getDate() &&
                                    year === today.getFullYear() &&
                                    month === today.getMonth()
                                ) {
                                    days += `<div class="day today">${i}</div>`;
                                } else {
                                    days += `<div class="day">${i}</div>`;
                                }
                            }

                            for (let j = 1; j <= nextDays; j++) {
                                days += `<div class="day next-date">${j}</div>`;
                            }
                        
                            daysContainer.innerHTML = days;
                        }

                        initCalendar();

                        function prevMonth() {
                            month--;
                            if (month < 0) {
                                month = 11;
                                year--;
                            }      
                            initCalendar();
                        }

                        function nextMonth() {
                            month++;
                            if (month > 11) {
                                month = 0;
                                year++;
                            }
                            initCalendar();
                        }

                        prev.addEventListener("click", prevMonth);
                        next.addEventListener("click", nextMonth);

                        function displayEventsForDate(date, events) {
                            const eventsContainer = document.querySelector(".events");
                            let eventList = "";

                            events.forEach((event) => {
                                const eventDate = new Date(event.end);
                                if (eventDate.getDate() === date.getDate() && eventDate.getMonth() === date.getMonth() && eventDate.getFullYear() === date.getFullYear()) {
                                    eventList += `
                                        <hr style="border: 1px solid #b8c1ec; margin: 1.5rem 0;">
                                        <div class="event_container">
                                            <h4><li>${event.title}</li></h4>
                                            <div class="event-details">
                                                <span>Customer Name: ${event.customer_name}</span>
                                                <span>Service Type: ${event.service_option_name}</span>
                                                <span>Laundry Cycle: ${event.laundry_cycle}</span>
                                                <span>Start: ${event.start}</span>
                                                <span>End: ${event.end}</span>
                                            </div>
                                        </div>
                                    `;
                                }  
                            });

                            eventsContainer.innerHTML = eventList;
                        }

                        daysContainer.addEventListener("click", (e) => {
                            if (e.target.classList.contains("day")) {
                                const day = parseInt(e.target.textContent);
                                const date = new Date(year, month, day);
                                displayEventsForDate(date, <?php echo json_encode($events); ?>);
                            }
                        });

                        displayEventsForDate(new Date().getDate(), <?php echo json_encode($events); ?>);
                    </script>
                </div> <!--END OF CALENDAR CONTAINER-->
            
                <div id="logoutModal" class="modal" style="display:none;">
                    <div class="modal-cont">
                        <span class="close">&times;</span>
                        <h2 id="logoutText">Do you want to logout?</h2>
                        <div class="modal-buttons">
                            <button class="btn btn-no">No</button>
                            <a href="/laundry_system/homepage/logout.php" class="btn btn-yes">Yes</a>
                        </div>
                    </div>
                </div>

        </div> <!--end of main content-->
    </div><!--end of wrapper--->
    
    
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="dashboard.js"></script>    
    <!-- Bootstrap 5 JS (required for modal functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>