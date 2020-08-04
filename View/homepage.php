<?php require 'includes/header.php'?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section>
    <h4>Hello <?php echo $customer->getLastname()?>,</h4>
    <p><a href="index.php?page=info">To info page</a></p>

    <p>Put your content here.</p>
    <!-- Products -->
    <section class="my-3">
        <form method="get">
            <div id="dropdown">
                <select class="mb-1" name="product">
                    <option value="0">Product</option>

                </select>
            </div>
            <input id="linkBtn" type="submit" name="send" value="Choose product">
        </form>
    </section>
    <!-- Customer -->
    <section class="my-3">
        <form method="get">
            <div id="dropdown">
                <select class="mb-1" name="customer">
                    <option value="0">Customer</option>

                </select>
            </div>
            <input id="linkBtn" type="submit" name="send" value="Select name">
        </form>
    </section>
    <!-- Customer group -->
    <section class="my-3">
        <form method="get">
            <div id="dropdown">
                <select class="mb-1" name="group">
                    <option value="0">Company</option>

                </select>
            </div>
            <input id="linkBtn" type="submit" name="send" value="Select company">
        </form>
    </section>
<?php require 'includes/footer.php'?>