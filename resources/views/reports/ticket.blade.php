<div class="page-wrapper">

<style>
    body {
        font-family: 'Inter', sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 30px;
        color: #111827;
    }

    .container {
        max-width: 1100px;
        margin: auto;
    }

    /* HEADER */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .header h1 {
        font-size: 22px;
        font-weight: 700;
    }

    .header span {
        font-size: 13px;
        color: #6b7280;
    }

    /* CARD */
    .card {
        background: #fff;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.06);
        margin-bottom: 20px;
    }

    .title {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #374151;
        border-left: 4px solid #3b82f6;
        padding-left: 10px;
    }

    /* GRID */
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 15px;
    }

    /* BOX */
    .box {
        padding: 18px;
        border-radius: 12px;
        color: white;
        text-align: center;
        transition: 0.2s;
    }

    .box:hover {
        transform: translateY(-3px);
    }

    .box h3 {
        font-size: 13px;
        opacity: 0.9;
        margin-bottom: 6px;
    }

    .box p {
        font-size: 24px;
        font-weight: 700;
        margin: 0;
    }

    /* COLORS */
    .total { background: linear-gradient(135deg,#2563eb,#1d4ed8); }
    .open { background: linear-gradient(135deg,#f59e0b,#d97706); }
    .closed { background: linear-gradient(135deg,#22c55e,#16a34a); }
    .pending { background: linear-gradient(135deg,#ef4444,#dc2626); }
    .progress { background: linear-gradient(135deg,#6366f1,#4338ca); }

</style>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div>
            <h1> Ticket Report Dashboard</h1>
            <span>System performance overview</span>
        </div>
    </div>

    <!-- SUMMARY -->
    <div class="card">
        <div class="title">Ticket Summary</div>

        <div class="grid">

            <div class="box total">
                <h3>Total Tickets</h3>
                <p>{{ $ticketsummary['total'] }}</p>
            </div>

            <div class="box open">
                <h3>Open</h3>
                <p>{{ $ticketsummary['open'] }}</p>
            </div>

            <div class="box closed">
                <h3>Closed</h3>
                <p>{{ $ticketsummary['close'] }}</p>
            </div>

            <div class="box pending">
                <h3>Pending</h3>
                <p>{{ $ticketsummary['pending'] }}</p>
            </div>

            <div class="box progress">
                <h3>In Progress</h3>
                <p>{{ $ticketsummary['inprogress'] }}</p>
            </div>

        </div>
    </div>

</div>

</div>