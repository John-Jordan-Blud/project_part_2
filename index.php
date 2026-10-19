<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta name = "description" content = "The home page of the Coal Miners Organisation">
    <meta name = "author" content = "Team Coal Miners">
    <meta name = "keywords" content = "Coal Miners">
    <title>Home | Team Coal Miners</title>
    <link rel = "stylesheet" href = "style/style.css">
    <link rel = "stylesheet" href = "style/index_style.css">
    <link rel="icon" type="images/x-icon" href="images/Logo.png">

    <!--The figcation would always be on the right side of the image rather than under it-->
        <!--/*This was fixed by using clear: both, which should also work on clear right, but remains untested*/-->
    <style>
        figcaption {
            clear: both;
            float: right;
        }
    </style>
        
</head>
<body>
    <header>
        <?php
            include('nav.inc')
        ?>

        <div id = "heading_background">
            <h1>Home</h1>
            
            <h2>
                Our work produces diamonds out of the darkest coal mines.
            </h2>
        </div>
    </header>

    <main>
        <section>
            <div class = "aside_left">
                <h3>What We Do</h3>
                <p>
                    We, at Team Coal Miners, are committed to improving the quality of life 
                    of Everyday Australians in Victoria through our digital services. As a 
                    growing organisation, we are looking for individuals who share a similar 
                    mindset to us, whilst possessing the skills necessary to maintain 
                    and expand our organisation.
                </p>

                <p>
                    Since our founding in 2026, our organisation has become an integral pillar 
                    of support for less developed Victorian communities through our digital 
                    services. We are primarily focused on the improvement of local communities 
                    through granting further access to support resources and services. Onwards from 2027, 
                    we plan to expand our digital network beyond Victoria to states such as 
                    Tasmania, New South Wales and Queensland.
                </p>
            </div>

            <!--Put the text on the left side of the screen and the images on the right side-->
            <!--Additionally, the images would not float properly, with the text avoiding the images entirely-->
            <!--This was fixed by putting the images before the p element-->
            <!--But a new problem occured as the image would appear before the text when on a smaller screen-->
            <a href = "https://www.istockphoto.com/photos/charity-worker">
                <img src = "images/StockPhoto.jpg"
                    alt = "Stock photo of a charity worker"
                    title = "Stock photo of a charity worker"
                    loading = "lazy">
            </a>
        </section>

        <section>
            <div class = "aside_left">
                <h3>Our Commitment to Reconciliation</h3>

                <p>
                    The Coal Miners, as part of our efforts towards reconciliation, seek to work 
                    with the Aboriginal and Torres Strait Islander peoples. The goal of this 
                    effort is to:
                    <br>
                </p>

                <ul>
                    <li>Expand peoples' knowledge and understanding of traditional culture.</li>
                    <li>Improve access to support services to more rural communities.</li>
                    <li>Support Aboriginal initiatives.</li>
                    <li>Promote a more cultural safe environment.</li>
                    <li>Operate within the boundaries of cultural customs and traditions.</li>
                </ul>

                <p>
                    By adhering to these principles, we hope to work with local representatives, 
                    leaders and knowledge holders, so that our operations and procedures can abide 
                    by local laws. Improving the lives of Aboriginal and Torres Strait 
                    Islander peoples.
                </p>
            </div>
            

            <figure>
                <a href = "https://thetorch.org.au/news/following-the-lines-wurundjeri/?srsltid=AfmBOorO8Wb3bYPGkzF5tKKaJI7dUTl4AQa2p8DHXgVpS9uywsG2F6ov">
                    <img src = "images/WurundjeriArt.jpg"
                        alt = "Generations of Wurundjeri by Stephen N of the Wurundjeri peoples"
                        title = "Generations of Wurundjeri by Stephen N of the Wurundjeri peoples"
                        loading = "lazy">
                </a>

                <figcaption>Generations of Wurundjeri, Acrylic canvas art
                    by Stephen N of the Wurundjeri peoples</figcaption>
            </figure>
        </section>

        <!--Putting the table in a section would allow for easier changes-->
        <section id = "table">
            <!--The problem with images mentioned beforehand also occurred here for the table-->
            <!--The difference is the solution did not quite work-->
            <!--The solution was found in index_style.css-->
            <h3>
                At Team Coal Miners, we utilise our resources to support 
                other organisations and initiatives that share our philosophy. 
                Here are other non-profit organisations we are currently 
                supporting.
            </h3>

            <!--ALIGN THE TEXT TO BE CENTRED-->
            <table>
                <caption><strong>Supported organisations</strong></caption>

                <thead>
                    <tr>
                        <th rowspan = "2" scope = "col">Organisations</th>
                        <th colspan = "4" scope = "col">Funds raised</th>
                    </tr>
                    <tr>
                        <th scope = "col">Donations</th>
                        <th scope = "col">Volunteer Work</th>
                        <th scope = "col">Grassroot Support</th>
                        <th scope = "col">Total</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th scope = "row"><a href = "https://www.makeawish.org.au/">Make-a-Wish Australia</a></th>
                        <td>$6,876</td>
                        <td>$4,192</td>
                        <td>$902</td>
                        <td>$11,970</td>
                    </tr>

                    <tr>
                        <th scope = "row"><a href = "https://www.redcross.org.au/">Australian Red Cross</a></th>
                        <td>$6,821</td>
                        <td>$1,508</td>
                        <td>$829</td>
                        <td>$9,158</td>
                    </tr>

                    <tr>
                        <th scope = "row"><a href = "https://kht.org.au/">Koorie Heritage Trust</a></th>
                        <td>$9,764</td>
                        <td>$2,625</td>
                        <td>$1,008</td>
                        <td>$13,397</td>
                    </tr>

                    <tr>
                        <th scope = "row"><a href = "https://www.vacca.org/">VACCA</a></th>
                        <td>$5,302</td>
                        <td>$2,218</td>
                        <td>$1,274</td>
                        <td>$8,694</td>
                    </tr>

                    <tr>
                        <th scope = "row"><a href = "https://intoourhandsfoundation.com.au/">Into Our Hands</a></th>
                        <td>$4,380</td>
                        <td>$3,265</td>
                        <td>$890</td>
                        <td>$8,535</td>
                    </tr>
                </tbody>

                <tfoot>
                    <tr>
                        <th colspan = "4" scope = "row">Grand Total</th>
                        <td>$51,754</td>
                    </tr>
                </tfoot>
            </table>
        </section>
    </main>


    <?php
        include('footer.inc')
    ?>

</body>
</html>
