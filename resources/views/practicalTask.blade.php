<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practical Task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>--}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>practical Task</h2>
    <div class="form-group">
        <label for="row">Rows</label>
        <input type="number" class="form-control rows" id="rows" min="1" placeholder="Enter Rows" name="rows">
    </div>
    <div class="form-group">
        <label for="column">Column</label>
        <input type="number" class="form-control cols" id="cols" placeholder="Enter column" name="cols">
    </div>
    <button onclick="generateMatrix()">Submit</button>
    <br><br>

    <div class="calculateData"></div>
</div>

<script>
    function generateMatrix() {
        var rows = parseInt($('.rows').val());
        var cols = parseInt($('.cols').val());

        var tableData = '<table>';
        var countNumber = 0;
        for (var i = 0; i < rows; i++) {
            tableData += '<tr>';
            for (var j = 0; j < cols; j++) {
                tableData += '<td><input type="number" class="inputData" data-row="' + i + '" data-col="' + j + '"></td>';
            }
            if (countNumber == 0) {
                tableData += '<td id="rowSum' + i + '"></td></tr>';
            }
            if (countNumber == 1) {
                tableData += '<td id="rowMult' + i + '"></td></tr>';
            }
            if (countNumber == 2) {
                tableData += '<td id="rowSub' + i + '"></td></tr>';
                countNumber = -1
            }
            countNumber++;
        }
        tableData += '<tr>';
        var newCunt = 0;
        for (var j = 0; j < cols; j++) {
            if (newCunt == 0) {
                tableData += '<td id="colSum' + j + '"></td>';
            }
            if (newCunt == 1) {
                tableData += '<td id="colMult' + j + '"></td>';
            }
            if (newCunt == 2) {
                tableData += '<td id="colSub' + j + '"></td>';
                newCunt = -1
            }
            newCunt++
        }
        tableData += '</tr></table>';

        $('.calculateData').html(tableData);

        $('.inputData').on('input', function () {
            calculateSums(rows, cols);
            calculateMultiplication(rows, cols);
            calculateSubtraction(rows, cols);
        });
    }

    function calculateSums(rows, cols) {
        for (var i = 0; i < rows; i++) {
            var rowSum = 0;
            for (var j = 0; j < cols; j++) {
                var val = parseFloat($('input.inputData[data-row="' + i + '"][data-col="' + j + '"]').val());
                if (!isNaN(val)) {
                    rowSum += val;
                }
            }
            $('td#rowSum' + i).text(' Sum: ' + rowSum);
        }

        for (var j = 0; j < cols; j++) {
            var colSum = 0;
            for (var i = 0; i < rows; i++) {
                var val = parseFloat($('input.inputData[data-row="' + i + '"][data-col="' + j + '"]').val());
                if (!isNaN(val)) {
                    colSum += val;
                }
            }
            $('td#colSum' + j).text(' Sum: ' + colSum);
        }
    }

    function calculateMultiplication(rows, cols) {
        for (var i = 0; i < rows; i++) {
            var rowMult = 1;
            for (var j = 0; j < cols; j++) {
                var val = parseFloat($('input.inputData[data-row="' + i + '"][data-col="' + j + '"]').val());
                if (!isNaN(val)) {
                    rowMult *= val;
                }
            }
            $('td#rowMult' + i).text('Multiplication: ' + rowMult);
        }

        for (var j = 0; j < cols; j++) {
            var colMult = 1;
            for (var i = 0; i < rows; i++) {
                var val = parseFloat($('input.inputData[data-row="' + i + '"][data-col="' + j + '"]').val());
                if (!isNaN(val)) {
                    colMult *= val;
                }
            }
            $('td#colMult' + j).text(' Multiplication: ' + colMult);
        }
    }

    function calculateSubtraction(rows, cols) {
        for (var i = 0; i < rows; i++) {
            for (var j = 0; j < cols; j++) {
                var val = parseFloat($('input.inputData[data-row="' + i + '"][data-col="' + j + '"]').val());
                var valAbove = parseFloat($('input.inputData[data-row="' + (i - 1) + '"][data-col="' + j + '"]').val());
                var valLeft = parseFloat($('input.inputData[data-row="' + i + '"][data-col="' + (j - 1) + '"]').val());
                var result = '';
                var resultN = '';
                if (!isNaN(val) && !isNaN(valAbove)) {
                    result += valAbove - val;
                    ;
                }
                if (!isNaN(val) && !isNaN(valLeft)) {
                    if (result !== '') result += ', ';
                    resultN = valLeft - val;
                }
                $('td#rowSub' + i).text('Subtraction: ' + resultN);
            }
        }

        for (var j = 0; j < cols; j++) {
            for (var i = 0; i < rows; i++) {
                var valJ = parseFloat($('input.inputData[data-row="' + i + '"][data-col="' + j + '"]').val());
                var valAboveJ = parseFloat($('input.inputData[data-row="' + (i - 1) + '"][data-col="' + j + '"]').val());
                var valLeftJ = parseFloat($('input.inputData[data-row="' + i + '"][data-col="' + (j - 1) + '"]').val());
                var resultJ = '';
                var resultNew = '';
                if (!isNaN(valJ) && !isNaN(valAboveJ)) {
                    resultJ += valAboveJ - valJ;
                }
                if (!isNaN(valJ) && !isNaN(valLeftJ)) {
                    if (resultJ !== '') resultJ += ', ';
                    resultNew = valLeftJ - valJ;
                }
                $('td#colSub' + j).text('Subtraction: ' + resultNew);
            }
        }
    }
</script>

</body>
</html>