@extends('layouts.app')

@section('content')
@include('components.navbarMy')

<style>
main {
    padding: 0px 20px 20px 20px;
    min-height: 400px;
}
.content-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}
h2 {
    font-size: 20px;
    font-weight: bold;
}
.btn-add {
    background-color: #3a7d34;
    color: white;
    border: none;
    margin: 15px;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
}
/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}
thead {
    background-color: #f2f2f2;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
}
th {
    text-align: left;
    padding: 10px;
    color: #666;
    color:black;
    font-weight:bold;

}
td {
    padding: 12px 10px;
    border-bottom: 1px solid #eee;
}
.release-link { color: #06c; text-decoration: none; }
.action-link { color: #762d7c; text-decoration: none; margin-right: 15px; }
.history-link { color: #06c; text-decoration: none; }
.btn-delete {
    background-color: #c9302c;
    color: white;
    border: none;
    padding: 6px 16px;
    border-radius: 3px;
    font-size: 14px;
    cursor: pointer;
}
</style>

    <div class="content-header">
        <h2>Drafts</h2>
        <button class="btn-add">+ Add a Release to the Database</button>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 55%;">Artist — Title — Label</th>
                <th style="width: 35%;">Actions</th>
                <th style="width: 10%;">Delete</th>
            </tr>
        </thead>
        <tbody>
            <!-- cth release yg dibuat user -->
            <tr>
                <td>
                    <a href="#" class="release-link">Ariana Grande – Eternal Sunshine — Bureau B</a>
                </td>
                <td>
                    <a href="#" class="action-link">Edit / Submit</a>
                    <a href="#" class="history-link">History</a>
                </td>
                <td>
                    <button class="btn-delete">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>

@endsection