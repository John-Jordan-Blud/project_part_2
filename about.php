<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Meet the team behind Team Coal Miners.">
    <meta name="author" content="Team Coal Miners">
    <meta name="keywords" content="about us, team, recruitment, coal miners">
    <title>About Us | Team Coal Miners</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/about.css">
    <link rel="icon" type="image/png" href="images/Logo.png">
    <style>
        .quote-original {
            font-style: italic;
        }
    </style>
</head>

<body>
    <?php
        include ('header.inc');
    ?>
    <main>
        <h1>About Us</h1>
        <section aria-labelledby="group-info-heading">
            <h2 id="group-info-heading">Our Group</h2>
            <ul>
                <li>Team Coal Miners
                    <ul>
                        <li>Tutorial Day: Wednesday, every week</li>
                        <li>Tutorial Time: 2:30pm to 4:30pm</li>
                    </ul>
                </li>
            </ul>
        </section>
        <section aria-labelledby="photo-heading">
            <h2 id="photo-heading">Group Photo</h2>
            <figure class="team-photo">
                <img src="images/group-photo.jpg" alt="The Team Coal Miners group standing together"
                    style="border: 2px solid #444444;">
                <figcaption>From left to right: Ryan, Minh, Chloe, Koktriv</figcaption>
            </figure>
        </section>
        <section aria-labelledby="members-heading">
            <h2 id="members-heading">Individual Members</h2>
            <div class="team-showcase">

                <section class="member-slide" aria-labelledby="chloe-heading">
                    <h3 id="chloe-heading">Chloe</h3>
                    <blockquote lang="zh">
                        <p class="quote-original">花开花落自有时，缘起缘灭无穷尽</p>
                        <p>English translation: "Just as flowers bloom and wilt, there is no end to fates entwining and
                            unwinding."</p>
                    </blockquote>
                    <dl>
                        <dt>Contributions</dt>
                        <dd>
                            <ul>
                                <li>Create HTML pages with boilerplate code, navigation and footer</li>
                                <li>Research and create 3 job listings</li>
                                <li>Team member profile</li>
                                <li>Submission</li>
                            </ul>
                        </dd>
                    </dl>
                </section>

                <section class="member-slide" aria-labelledby="ryan-heading">
                    <h3 id="ryan-heading">Ryan <span class="student-id"><!-- TODO: student ID --></span></h3>
                    <blockquote lang="zh">
                        <p class="quote-original">"千里之行，始於足下"</p>
                        <p>English translation: "A journey of a thousand steps starts beneath one's feet." <cite>&mdash;
                                Lao Tzu</cite></p>
                    </blockquote>
                    <dl>
                        <dt>Contributions</dt>
                        <dd>
                            <ul>
                                <li>Team member profile</li>
                                <li>CSS</li>
                            </ul>
                        </dd>
                    </dl>
                </section>

                <section class="member-slide" aria-labelledby="minh-heading">
                    <h3 id="minh-heading">Minh</h3>
                    <blockquote lang="de">
                        <p class="quote-original">Wussten Sie, dass SkyNet ein echtes Unternehmen ist? Es ist ein
                            chinesisches &Uuml;berwachungsunternehmen.</p>
                        <p>English translation: "Did you know that SkyNet is an actual company? It is a Chinese
                            surveillance company."</p>
                    </blockquote>
                    <dl>
                        <dt>Contributions</dt>
                        <dd>
                            <ul>
                                <li>Team member profile</li>
                                <li>Team member logo</li>
                                <li>Company slogan and description</li>
                            </ul>
                        </dd>
                    </dl>
                </section>

                <section class="member-slide" aria-labelledby="koktriv-heading">
                    <h3 id="koktriv-heading">Koktriv</h3>
                    <blockquote lang="km">
                        <p class="quote-original">កុំចាក់អង្ករ យកអង្កាម</p>
                        <p>English translation: "Don't pour out the rice and keep the husk."</p>
                    </blockquote>
                    <dl>
                        <dt>Contributions</dt>
                        <dd>
                            <ul>
                                <li>Team member profile</li>
                                <li>Group photo</li>
                                <li>About.html</li>
                            </ul>
                        </dd>
                    </dl>
                </section>

            </div>
            <section>
                <h3 id="funfacts-heading">Fun Facts</h3>
                <table class="team-table">
                    <caption>A few things you might not know about us</caption>
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Fun Fact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Chloe</td>
                            <td>My favourite TV show is Survivor.</td>
                        </tr>
                        <tr>
                            <td>Ryan</td>
                            <td>I enjoy playing chess.</td>
                        </tr>
                        <tr>
                            <td>Minh</td>
                            <td>I like watching robot fighting, especially those leagues in China.</td>
                        </tr>
                        <tr>
                            <td>Koktriv</td>
                            <td>I can speak 5 languages.</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </section>
    </main>
    <footer>
        <p>
            In the spirit of reconciliation, we at the Coal Miners acknowledge the Aboriginal and Torres Strait Islander
            people as the traditional owners and custodians of Country. We pay our respects to their culture and elders,
            past, present and emerging.
        </p>
        <p>
            <a href="https://chloejadeyoung07.atlassian.net/jira/software/projects/TCM/boards/2/backlog?epics=visible&amp;atlOrigin=eyJpIjoiNDM3ZDdhZmE2NjMyNGMxZThjNDA0ZGI0YjI0YjcxYzMiLCJwIjoiaiJ9"
                title="JIRA Board">JIRA</a> |
            <a href="https://github.com/John-Jordan-Blud/Assignment_1_Coal_Miners_JOB"
                title="GitHub Repository">GitHub</a> |
            <a href="mailto:hello@teamcoalminers.com.au">hello@teamcoalminers.com.au</a>
        </p>
    </footer>
</body>
</html>
