<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        h2 {
            margin: 0;
        }
        :root {
            color-scheme: light dark;
            supported-color-schemes: light dark;
        }

        .webkit {
            margin: 0 auto;
            margin-top: 15px;
        }

        @media screen and (max-width: 610px) {
            .td100pr {
                max-width: none;
            }

            .webkit {
                margin-top: 0px;
            }
        }

        .two-column .column {
            max-width: 260px;
        }

        .three-column .column {
            max-width: 170px;
        }

        .tdcenter {
            text-align: left;
        }

        .padleft0 {
            padding-left: 10px;
        }

        .hide {
            width: 100%;
            max-width: 140px;
            border: 0;
            display: block;
        }

        @media screen and (max-width: 480px) {
            .two-column .column,
            .three-column .column {
                max-width: 100%;
            }

            .two-column img {
                max-width: 100%;
            }

            .three-column img {
                max-width: 50%;
            }

            .tdcenter {
                text-align: center;
            }

            .tdtext0 {
                padding-left: 0px;
                padding-right: 0px;
            }

            .padleft0 {
                padding-left: 0;
            }
        }

        @media screen and (max-width: 497px) {
            .hide {
                display: none;
            }
        }

        .tdtext {
            padding-left: 40px;
            padding-right: 40px;
        }

        .tdtext25 {
            padding-left: 25px;
            padding-right: 25px;
        }

        @media screen and (max-width: 400px) {
            .tdtext,
            .tdtext25 {
                padding-left: 15px;
                padding-right: 15px;
            }

        }

        @media screen and (min-width: 481px) and (max-width: 670px) {
            .three-column .column {
                max-width: 33%;
            }

            .two-column .column {
                max-width: 50%;
            }
        }

        table {
            border-collapse: collapse;
        }


        .accordion-title {
            display: flex;
            justify-content: space-between;
        }

        .accordion-title span:nth-child(2) {
            text-align: right;
        }
    </style>
    <!--
      Note: The entire `<style>` tag cannot exceed 75,000 bytes. The validator will check for this.
    -->
    <!-- -->
</head>
