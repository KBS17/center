<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Satisfaction Survey</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Customer Satisfaction Survey</h1>
        <form>
            <!-- Part 1: Personal Information -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" class="form-control" id="age" placeholder="Enter your age">
            </div>
            <div class="form-group">
                <label>Gender:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                    <label class="form-check-label" for="other">Other</label>
                </div>
            </div>
            <div class="form-group">
                <label for="occupation">Occupation:</label>
                <input type="text" class="form-control" id="occupation" placeholder="Enter your occupation">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email">
            </div>
            <!-- Part 2: Product/Service Feedback -->
            <div class="form-group">
                <label>How often do you use our product/service?</label>
                <select class="form-control" id="usage">
                    <option>Daily</option>
                    <option>Weekly</option>
                    <option>Monthly</option>
                    <option>Rarely</option>
                </select>
            </div>
            <div class="form-group">
                <label>How would you rate your overall satisfaction with our product/service?</label>
                <select class="form-control" id="satisfaction">
                    <option>Very Satisfied</option>
                    <option>Satisfied</option>
                    <option>Neutral</option>
                    <option>Dissatisfied</option>
                    <option>Very Dissatisfied</option>
                </select>
            </div>
            <div class="form-group">
                <label>How would you rate the quality of our product/service?</label>
                <select class="form-control" id="quality">
                    <option>Excellent</option>
                    <option>Good</option>
                    <option>Average</option>
                    <option>Poor</option>
                    <option>Very Poor</option>
                </select>
            </div>
            <div class="form-group">
                <label>How likely are you to recommend our product/service to others?</label>
                <select class="form-control" id="recommend">
                    <option>Very Likely</option>
                    <option>Likely</option>
                    <option>Neutral</option>
                    <option>Unlikely</option>
                    <option>Very Unlikely</option>
                </select>
            </div>
            <div class="form-group">
                <label>How would you rate the value for money of our product/service?</label>
                <select class="form-control" id="value">
                    <option>Excellent</option>
                    <option>Good</option>
                    <option>Average</option>
                    <option>Poor</option>
                    <option>Very Poor</option>
                </select>
            </div>
            <!-- Part 3: Additional Comments -->
            <div class="form-group">
                <label for="comments">What do you like most about our product/service?</label>
                <textarea class="form-control" id="comments" rows="3" placeholder="Enter your comments"></textarea>
            </div>
            <div class="form-group">
                <label for="improvements">What can we improve about our product/service?</label>
                <textarea class="form-control" id="improvements" rows="3" placeholder="Enter your suggestions"></textarea>
            </div>
            <div class="form-group">
                <label for="additionalComments">Do you have any other comments or suggestions?</label>
                <textarea class="form-control" id="additionalComments" rows="3" placeholder="Enter your additional comments"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>