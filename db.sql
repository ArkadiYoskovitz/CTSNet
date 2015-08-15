-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 15, 2015 at 06:17 AM
-- Server version: 5.5.42-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cts_net_db`
--
CREATE DATABASE IF NOT EXISTS `cts_net_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cts_net_db`;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ArticleID',
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'article title data',
  `header` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'article sub title data',
  `body` varchar(5000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'article data',
  `conclusion` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'article conclusion data',
  `summary` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'article summary, used on main page',
  `image_path` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `writer_id` int(11) NOT NULL,
  `date_creation` date NOT NULL,
  `date_last_modification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `article_status` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article_status` (`article_status`),
  KEY `writer_id` (`writer_id`),
  KEY `category_id` (`category_id`),
  KEY `image_id` (`image_path`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=54 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `header`, `body`, `conclusion`, `summary`, `image_path`, `writer_id`, `date_creation`, `date_last_modification`, `article_status`, `category_id`) VALUES
(1, 'Cadillac Chief Says Autonomy from GM Coming by 2017', 'Cadillac Chief Says Autonomy from GM Coming by 2017', 'Speaking yesterday to analysts and as reported by Automotive News, Cadillac chief Johan de Nysschen has put a timetable on the luxury brand’s move toward autonomy from General Motors. The executive says he expects the brand to splinter from GM and have “a far higher degree of autonomy and self sufficiency” by 2017.\r\n\r\nMore general word of the move to make Cadillac a separate business unit—which will mean reporting its own financial results—came almost a year ago. It was also announced at that time that Cadillac’s headquarters would be relocated from Detroit to Manhattan, a move that didn’t sit well with fans of a brand named after the French explorer who founded the outpost that eventually became the Motor City. De Nysschen quickly defended the strategy, saying “if we don’t move, nothing will change. Physical relocation forces a change to processes. Now, it’s true, we could achieve that by moving just about anywhere. But if you have to choose a place to set up an iconic global luxury brand, you could indeed do worse than New York.”\r\n\r\nIn his most recent comments, the executive said that one of his primary goals is to unplug Cadillac from the GM sales and marketing machine in order to strengthen buyers’ perception of the brand—and to allow dealers to focus more strongly on customer experience and brand-building rather than incentives and hitting sales targets.\r\n\r\nDe Nysschen also acknowledged that once the CT6 sedan and the SRX-replacing XT5 crossover hit the streets, there will be some time before we see additional new products—early 2018 or possibly later—as part of a product offensive that will include more crossovers, a plug-in-hybrid model, a full EV, and more. All of this is part of a strategy aimed at nearly doubling Cadillac’s global sales by 2020, to 500,000 vehicles.', ' a plug-in-hybrid model, a full EV, and more. All of this is part of a strategy aimed at nearly doub', 'Speaking yesterday to analysts and as reported by Automotive News,', '/images/cad.jpg\n', 3, '0000-00-00', '2015-08-14 07:32:54', 4, 3),
(2, 'President Obama’s Letter to the Editor', 'President Obama’s Letter to the Editor', 'For the cover story of our Aug. 2 issue,\r\nJim Rutenberg wrote about efforts over the last 50 years\r\n \r\nto dismantle the protections in the Voting Rights Act of\r\n \r\n1965, the landmark piece of legislation that cleared\r\n \r\nbarriers between black voters and the ballot.\r\n \r\nThe story surveyed a broad sweep of history and characters,\r\n \r\nfrom United States Chief Justice John Roberts to ordinary\r\n \r\ncitizens like 94-year-old Rosanell Eaton,\r\n \r\na plaintiff in the current North Carolina case arguing to\r\n \r\nrepeal voting restrictions enacted in 2013.\r\n \r\nThe magazine received an unusual volume of responses to this\r\n \r\narticle, most notably from President Barack Obama.\r\n \r\nI was inspired to read about unsung American heroes like\r\n \r\nRosanell Eaton in Jim Rutenberg’s ‘‘A Dream Undone: Inside the\r\n \r\n50-year campaign to roll back the Voting Rights Act.’’\r\n \r\n‘‘We the People of the United States,\r\n \r\nin Order to form a more perfect Union.\r\n \r\n...’’ It’s a cruel irony that the words that set our democracy\r\n \r\nin motion were used as part of the so-called literacy test\r\n \r\ndesigned to deny Rosanell and so many other African-Americans\r\n \r\nthe right to vote. Yet more than 70 years ago, as she defiantly\r\n \r\ndelivered the Preamble to our Constitution, Rosanell also\r\n \r\nreaffirmed its fundamental truth. What makes our country great\r\n \r\nis not that we are perfect, but that with time, courage and effort,\r\n \r\nwe can become more perfect. What makes America special is our\r\n \r\ncapacity to change.\r\n \r\nNearly three decades after Rosanell testified to her unbroken\r\n \r\nfaith in this country, that faith was vindicated.\r\n \r\nThe Voting Rights Act put an end to literacy tests and other\r\n \r\nforms of discrimination, helping to close the gap between our\r\n \r\npromise that all of us are created equal and our long history\r\n \r\nof denying some of us the right to vote. The impact was immediate,\r\n \r\nand profound — the percentage of African-Americans registered to\r\n \r\nvote skyrocketed in the years after the Voting Rights Act was passed.\r\n \r\nBut as Rutenberg chronicles, from the moment the ink was dry on the\r\n \r\nVoting Rights Act, there has been a concentrated effort to undermine\r\n \r\nthis historic law and turn back the clock on its progress.\r\n \r\nHis article puts the recent push to restrict Americans’\r\n \r\nvoting rights in its proper context. These efforts are not a sign\r\n \r\nthat we have moved past the shameful history that led to the\r\n \r\nVoting Rights Act. Too often, they are rooted in that history.\r\n \r\nThey remind us that progress does not come easy,\r\n \r\nbut that it must be vigorously\r\n \r\nI am where I am today only because men and women like Rosanell Eaton\r\n \r\nrefused to accept anything less than a full measure of equality.\r\n \r\nTheir efforts made our country a better place.\r\n \r\nIt is now up to us to continue those efforts.\r\n \r\nCongress must restore the Voting Rights Act.\r\n \r\nOur state leaders and legislatures must make it easier\r\n \r\n— not harder — for more Americans to have their voices heard.\r\n \r\nAbove all, we must exercise our right as citizens to vote,\r\n \r\nfor the truth is that too often we disenfranchise ourselves.\r\n \r\nRosanell is now 94 years old. She has not given up.\r\n \r\nShe’s still marching. She’s still fighting to make real the promise\r\n \r\nof America. She still believes that We the People have the awesome\r\n \r\npower to make our union more perfect. And if we join her, we, too,\r\n \r\ncan reaffirm the fundamental truth of the words Rosanell recited.', 'President Barack Obama, Washington\r\n', 'President Obama’s Letter to the Editor', '/images/unnamed.jpg\n', 2, '0000-00-00', '2015-08-14 07:33:28', 4, 1),
(3, '2017 Bentley Bentayga Revealed In 1/18th Scale, Seems 18/18ths Accurate', 'Besides having a name that lends itself to long,\r\ndrawn-out development cycles—what’s Bentayga’n you', '\r\nBesides having a name that lends itself to long,\r\ndrawn-out development cycles—what’s Bentayga’n you so long, \r\nBentley SUV?—Bentley’s much-delayed upcoming Bentayga remains an unknown quantity, \r\nat least visually. Despite several teasers and a failed design concept that forced \r\nBentley to go back and restyle the thing, we still don’t know what the big crossover\r\n looks like. Make that we “didn’t know” what it looks like, if toy-car photos of the \r\nBentayga dredged up by CarNewsChina are legit.\r\n\r\n\r\nApparently, a maker of model cars leaked images of its fancy new 1/18-scale Bentley Bentayga model,\r\nand if the toy is in fact accurate, it gives up the beans on Bentley’s big reveal for the 2015 Frankfurt auto show.\r\nNot much about the crossover’s appearance is a surprise, from the Flying Spur–style front end to the\r\nkick-up character line defining each rear fender. In nearly every respect, this looks like a Flying Spur\r\nwagon on stilts, a general theme backed up by our spy photos of Bentayga prototypes.\r\n\r\nWhen the life-size Bentayga SUV does arrive, expect it to come with a W-12 engine to start,\r\nwith diesel and plug-in hybrid options (one or both of which might not make it to the U.S.) \r\njoining the party later. It technically shares underpinnings with the latest Audi Q7, \r\nbut the entire vehicle will be suitably beefed up to Bentley’s luxe standards. Also, \r\nfans of puns, please note that, should any of your friends purchase a Bentayga, \r\nusing the joke “what’s Bentayga’n you so long” when awaiting their arrival will never get old. \r\nNever. In the meantime, head over to CarNewsChina for more images of the purported Bentayga model.', ' please note that, should any of your friends purchase a Bentayga, \r\nusing the joke “what’s Bentayga', '\r\nBesides having a name that lends itself to long,\r\ndrawn-out development cycles—what’s Bentayga’n you so long, ', '/images/thRSCKU344.jpg\n', 3, '0000-00-00', '2015-08-14 07:34:25', 4, 3),
(4, ' Chris Froome: Athletics should follow cycling anti-doping lead', 'Cycling''s problems with drugs are well documented but the sport''s blackest days appear to be behind ', 'Cycling''s problems with drugs are well documented but the sport''s blackest days appear to be behind it. \r\n\r\nBut the ongoing doping allegations in athletics threaten to overshadow this month''s World Championships in Beijing. \r\n\r\n"From what I understand, the testing hasn''t been at the level that it is in cycling," Froome told BBC Sport. \r\n\r\nHe said the International Cycling Union (UCI) spends about four times what the International Association of Athletics Federations (IAAF) does on testing. \r\n\r\n"It is going to have to invest a lot more heavily in anti-doping," he added. "That would be a step in the right direction." \r\n\r\nTrack and field''s governing body spends about £1.3m a year on anti-doping, whereas its cycling equivalent spends closer to £6m, although much of that comes from the professional teams as a condition of their licences to race in UCI competitions. \r\n\r\n"I believe some things have changed quite substantially [for cycling] since the dark ages of 10 to 15 years ago when the sport was really dirty," said Froome, in an exclusive interview with the BBC''s sports editor Dan Roan. \r\n\r\n"The testing has really evolved and the UCI has now implemented 24-hour testing. I have every confidence that the system now really works." \r\n\r\nThe 30-year-old Briton, who confirmed this week he will be lining up at the Vuelta later this month, revealed that he had been tested at his Monaco apartment on Sunday night and had no problem with being woken up at 3am by testers, if that is what it takes to assure fans he is clean.\r\nHow has athletics reached this point?\r\n\r\nEarlier this year, a BBC investigation revealed allegations of doping by leading US track coach Alberto Salazar and one of his star pupils, American distance runner Galen Rupp. Both men deny the claims. \r\n\r\nThis hit the sport hard, especially coming after revelations about the apparent return of state-sponsored doping in Russia, as well as lingering distrust of the quality of testing in athletics powerhouses Kenya and Jamaica. \r\n\r\nBut worse was to come earlier this month when a joint investigation by German broadcaster ARD and British newspaper The Sunday Times uncovered a decade''s worth of suspect blood values that cast a shadow over six World Championships and three Olympics. \r\n  \r\nFroome, speaking during the 2015 Tour de France, questioned critics\r\n   \r\nThe sense of crisis has not been helped by the fact the IAAF is also in the midst of an election battle to replace long-standing president Lamine Diack, with the two contenders, Ukrainian pole vault legend Sergey Bubka and British running great Lord Coe, trading promises to get tougher with cheats while simultaneously suggesting the sport is being unfairly treated\r\n\r\nA familiar story for cycling\r\n\r\nCycling fans watched the sport almost destroy itself by failing to face up to its obvious problems, often wasting resources on attacking the messenger instead. \r\n\r\nThe legacy of cycling''s tainted era is all too obvious to Froome, who has been subjected to constant sniping about his performances since his breakthrough at the 2011 Vuelta, where he finished second, and subsequent Tour wins in 2013 and 2015. \r\n\r\nThe sniping got nasty this year, with one fan throwing urine at him on a mountain stage and others spitting at him. His team-mate Richie Porte was even punched during one stage. \r\nA familiar story for cycling\r\n\r\nCycling fans watched the sport almost destroy itself by failing to face up to its obvious problems, often wasting resources on attacking the messenger instead. \r\n\r\nThe legacy of cycling''s tainted era is all too obvious to Froome, who has been subjected to constant sniping about his performances since his breakthrough at the 2011 Vuelta, where he finished second, and subsequent Tour wins in 2013 and 2015. \r\n\r\nThe sniping got nasty this year, with one fan throwing urine at him on a mountain stage and others spitting at him. His team-mate Richie Porte was even punched during one stage. \r\n"But I don''t think any sportsman should have to go through what we went through during this year''s Tour de France." \r\n\r\nIn an attempt to dispel the "negativity" that surrounded Froome in the days immediately after his superb victory in the Tour''s 10th stage, Team Sky released his performance data from that day''s final climb, and he has also promised to undergo independent physiological tests that he will share publicly. \r\n\r\n"It''s something I wanted to do from the start of the season, even before all this came up during the Tour," he said. \r\n\r\n"The physiological testing could even help me understand what makes me who I am and what it is about me that allows me to make the efforts I do." \r\n\r\nHe added that he was "open" to doing the VO2 Max test  that many pundits have been asking for, and plans were in place to do the peak oxygen uptake assessment but he "would not be rushing into it". \r\n\r\n"I do want to be a spokesman for clean cycling," he said. "I believe somebody has to stand up for the current generation. \r\n\r\n"I''m happy t', '\r\n"You think: ''Hold on a minute, are we all just wasting our time here?'' If a good performance is ju', 'Britain''s double Tour de France champion Chris Froome has urged athletics to follow cycling''s lead and invest a lot more money in anti-doping. \r\n', '/images/Chris_Froome_3102996b.jpg\n', 3, '0000-00-00', '2015-08-14 07:35:44', 4, 4),
(5, 'Everton defender not for sale - Roberto Martinez', 'Everton manager Roberto Martinez has insisted defender John Stones will not be sold to Chelsea.', 'The Premier League champions are expected to return with a third bid for the 21-year-old England international after a failed £26m offer. \r\n\r\nMartinez was critical of Chelsea after a first £20m bid was made public. \r\n\r\nAnd when asked about another possible approach for Stones on Thursday, Martinez said: "The player is not for sale and that is the end of it." \r\n\r\nHe added: "Our situation has been very clear from the beginning. We are not a selling club who will lose our best performers." \r\n\r\nStones, who made 23 Premier League appearances last season, signed a new five-year contract with the Godison Park club last August. \r\n\r\nHe was bought for £3m from Barnsley in 2013 and has since been capped four times by his country. \r\n\r\nTeenager Mason Holgate has followed the same path after joining Everton from the League One side on Thursday for an undisclosed fee. \r\n\r\nHowever, Martinez denied Holgate, 18, was being signed as a replacement for Stones: "He will be a phenomenal young prospect coming into that golden generation we feel we have at the club and he will be a good one for the future." \r\n\r\nMeanwhile, the Toffees are set to find out on Thursday how long England left-back Leighton Baines could be out for after injuring an ankle which was only operated on at the end of last season. \r\n\r\n"We will get the results of the scan and we will get a clear idea of the problem," Martinez said. \r\n', '"We will get the results of the scan and we will get a clear idea of the problem," Martinez said. \r\n', 'Everton manager Roberto Martinez has insisted defender John Stones will not be sold to Chelsea.', '/images/John-Stones.jpg\n', 3, '0000-00-00', '2015-08-14 07:36:57', 4, 4),
(6, 'No More ''CDs For a Penny'': Columbia House Blames Streaming for Bankruptcy', 'The music died for Columbia House on Monday when its parent company filed for Chapter 11 bankruptcy ', 'As anyone with a dusty Hootie & the Blowfish album probably knows, Columbia House became popular in the 1990s as the business that would sell you eight CDs for a penny. \r\nThen came Napster, iTunes, and now Spotify, which offers more than 30 million songs for zero pennies. Other streaming services, like Apple Music and Tidal, also give consumers a nearly endless supply of albums for a monthly fee. \r\n"The business has been in decline for approximately two decades, driven by the advent of digital media and resulting declines in the recorded music business," Columbia House''s parent company, Filmed Entertainment, said in a statement on Monday. \r\nEven iTunes seems outdated now. In the first half of 2015, on-demand streaming of music was up 92.4 percent, while CD and digital track sales were down 10 percent, according to Nielsen. Ironically, sales of vinyl records — which is what Columbia House sold when it was founded in 1955 — were actually up by 38 percent. \r\nNot that anyone was receiving albums in the mail from Columbia House recently. It shut down its music club in 2010 to focus on selling DVDs -- another technology that is threatened by digital streaming. \r\n\r\n', 'Not that anyone was receiving albums in the mail from Columbia House recently. It shut down its musi', 'The music died for Columbia House on Monday when its parent company filed for Chapter 11 bankruptcy protection', '/images/col.jpg\n', 3, '0000-00-00', '2015-08-14 07:39:05', 4, 2),
(7, 'Verizon Tests Internet Technology That''s 10X Faster Than Google Fiber', 'Verizon says it has successfully tested new technology that would allow it to deliver Internet ', 'Verizon says it has successfully tested new technology that would allow it to deliver Internet broadband speeds of up to 10 gigabits per second — which is 10 times faster than the speed of Google Fiber. \r\nThat is pretty fast, considering that Google Fiber is already 100 times faster than the average broadband connection. \r\nVerizon tested its next-generation passive optical network, or NG-PON2, between its office in Framingham, Massachusetts, and a house three miles away. At those speeds, the company said, a two-hour HD movie could be downloaded in eight seconds, much faster than the 17 minutes it would take on Verizon''s current network. \r\n\r\nFiber-optic cables, like the ones used by Google Fiber and Verizon FiOS, transmit light signals over incredibly thin strands of glass. Verizon''s new technology, the company said, works by "simply adding new colors of light onto the existing fiber." It would be possible, Verizon said, to boost speeds as high as 40 to 80 gigabits per second. \r\nRelated: Verizon Ditches Two-Year Phone Contracts and Unveils New Rate Plans \r\nFor now, that is more speed than most people need, but as bandwidth-intensive technologies like 4K video become more widespread, customers might be willing to pay big bucks for blazing fast Internet. \r\n', 'Related: Verizon Ditches Two-Year Phone Contracts and Unveils New Rate Plans \r\nFor now, that is more', 'Verizon says it has successfully tested new technology that would allow it to deliver Internet ', '/images/tech1.jpg\n', 3, '0000-00-00', '2015-08-14 07:41:14', 4, 2),
(8, 'ISIS Affiliate in Egypt Says It Has Beheaded a Croatian Man', 'CAIRO — The Egyptian affiliate of the Islamic State said on Wednesday that it had beheaded ', 'CAIRO — The Egyptian affiliate of the Islamic State said on Wednesday that it had beheaded a Croatian man who was taken from his car on the outskirts of Cairo last month.\r\nThe claim, if confirmed, would be the first time that militants in Egypt had abducted and killed a foreigner during two years of attacks against the government of President Abdel Fattah el-Sisi.\r\nThe man, Tomislav Salopek, 30, a married father of two, worked for a subsidiary of a French company in Egypt that serviced the oil and gas business.\r\nA photograph posted on Wednesday on a Twitter account affiliated with the \r\nmilitant group, which is called Sinai Province, appeared to show Mr. Salopek’s body, \r\nbeheaded and lying in the desert with a knife nearby.\r\nThe group released a video last week saying that Mr. Salopek would be killed \r\nwithin 48 hours unless the Egyptian government released Muslim women from prisons. \r\nThe deadline expired on Friday.\r\nIn the Twitter posting on Wednesday, the militants said Mr. Salopek had been killed \r\nbecause of Croatia’s “participation in the war against the Islamic State.”\r\nEgypt has been battling a hard-core jihadist insurgency since 2013, \r\nbut the killing of Mr. Salopek would signal a violent shift of focus for the militants, who have directed most of their \r\nattacks at the state’s security services.\r\nThe beheading would evoke the brutal tactics of militants in Syria and Iraq, \r\nand it would represent greater peril for foreigners in Egypt, whose economy is heavily \r\ndependent on tourism and on multinational companies.\r\n\r\n\r\n\r\nThe claims that Mr. Salopek had been killed appeared to be timed to undermine\r\nMr. Sisi, coming a few days after the government held a lavish celebration for \r\nthe opening of a new channel of the Suez Canal that was attended by hundreds of foreign dignitaries.\r\nAfter killing hundreds of soldiers and police officers over the last two years, the militants have\r\nshifted tactics noticeably in the last few months, attacking two of Egypt’s most popular tourist\r\ndestinations and detonating a car bomb outside the Italian Consulate in Cairo.\r\n\r\n', 'The claims that Mr. Salopek had been killed appeared to be timed to undermine\r\nMr. Sisi, coming a fe', 'CAIRO — The Egyptian affiliate of the Islamic State said on Wednesday that it had beheaded ', '/images/cairo.jpg\n', 3, '0000-00-00', '2015-08-14 07:42:48', 4, 1),
(9, 'Reporting From Iran, Jewish Paper Sees No Plot to Destroy Israel', 'The first journalist from an American Jewish pro-Israel publication to be given an Iranian visa ', 'The first journalist from an American Jewish pro-Israel publication to be given an Iranian visa since 1979 reported Wednesday that he had found little evidence to suggest that Iran wanted to destroy Israel, as widely asserted by critics of the Iranian nuclear agreement.\r\nThe journalist, Larry Cohler-Esses, assistant managing editor for news at The Forward, an influential New York-based newspaper catering to American Jews, also wrote that people in Iran, including its Jews, were eager for outside interaction and willing to speak critically about their government.\r\nWhile he heard widespread criticism of the Israeli government and its policies toward the Palestinians, Mr. Cohler-Esses wrote, he also found support among some senior clerics for a two-state solution, should the Palestinians pursue that outcome.\r\n“Though I had to work with a government fixer and translator, I decided which people I wanted to interview and what I would ask them,” Mr. Cohler-Esses wrote in the first of at least two articles from his July reporting trip. “Far from the stereotype of a fascist Islamic state, I found a dynamic push-and-pull between a theocratic government and its often reluctant and resisting people.”\r\nMr. Cohler-Esses’s reporting, coming as Congress prepares to vote on the nuclear agreement next month, presents a more nuanced view of Iran compared with the dark descriptions advanced by a number of Jewish-American advocacy groups that consider Iran a rogue enemy state.\r\nMany of those groups have exhorted lawmakers to reject the nuclear agreement, which will end sanctions in return for verified guarantees that Iran’s nuclear work remains peaceful\r\n\r\n“Ordinary Iranians with whom I spoke have no interest at all in attacking Israel,” Mr. Cohler-Esses wrote. “Their concern is with their own sense of isolation and economic struggle.”\r\nAmong some of Iran’s senior ayatollahs and prominent officials, he wrote, there is also dissent from the official line against Israel.\r\n“No one had anything warm to say about the Jewish state,” he wrote. “But pressed as to whether it was Israel’s policies or its very existence to which they objected, several were adamant: It’s Israel’s policies.”\r\nWhile he wrote that there was no freedom of the press in Iran, “freedom of the tongue has been set loose.”\r\n“I was repeatedly struck by the willingness of Iranians to offer sharp, even withering criticisms of their government on the record, sometimes even to be videotaped doing so,” Mr. Cohler-Esses wrote.\r\nHe added that members of Iran’s Jewish population of 9,000 to 20,000 people, “depending on whom you talk to,” were also unafraid to complain about discriminatory laws that restrict their ability to work in the government.\r\nHe described them as “basically well-protected second-class citizens — a broadly prosperous, largely middle-class community whose members have no hesitation about walking down the streets of Tehran wearing yarmulkes.”\r\nIran’s government, he wrote, “makes a rigid distinction between hostility to ‘the Zionist entity’ and respect for followers of Judaism.”\r\nMr. Cohler-Esses, who taught English in Iran for a few years before the 1979 Islamic revolution that toppled the shah, spent nearly two years trying to secure a journalist visa, after the election of President Hassan Rouhani in June 2013. Mr. Rouhani vowed to resolve Iran’s nuclear dispute with foreign powers, end international sanctions and reintegrate the country into the world.\r\n\r\nInitially hoping to interview Mr. Rouhani when he visited the United Nations in September 2013, Mr. Cohler-Esses wrote that Iran’s United Nations mission advised him to seek a visa to visit Iran instead. He tried at least twice.\r\nJane Eisner, The Forward’s editor in chief, said in a telephone interview on Tuesday that the visa was finally granted after Morris Motamed, a Jewish former member of Iran’s Parliament, wrote a letter supporting the application.\r\n“What we’ve been told by the Iranians is that his letter of support really made the difference,” Ms. Eisner said.\r\nMr. Cohler-Esses was given a seven-day visa late last month, which he had to use within 30 days, she said. His request to extend the visa was denied.\r\nIt is unclear whether the government’s decision to grant the visa was related to hopes of positive American portrayals of the nuclear agreement, which was completed in Vienna on July 14.\r\nMs. Eisner said the Iranian authorities appeared to have made no effort to restrict Mr. Cohler-Esses’s access to a list of interview prospects he presented, including some senior clerics close to Ayatollah Ali Khamenei, Iran’s supreme leader.\r\n“I think it was because he had done so much homework,” she said of Mr. Cohler-Esses. “He was racing all over the country.”\r\nMr. Cohler-Esses was on vacation and unavailable to speak about his reporting. Ms. Eisner said he was planning a second article focusing on Iran’s Jewish community.\r\nThe Forward, started in New York as a Yiddish-language publication in 1897 cat', '“Those looking for assurances that access to trade and credit will help Iran evolve into a more enli', 'The first journalist from an American Jewish pro-Israel publication to be given an Iranian visa ', '/images/iran.jpg\n', 3, '0000-00-00', '2015-08-14 07:44:54', 4, 1),
(53, 'TEST 02', 'TEST 02', 'TEST 02', 'TEST 02', 'TEST 02', '/images/Linkedin Profile.png', 2, '0000-00-00', '2015-08-15 11:52:29', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `article_status`
--

DROP TABLE IF EXISTS `article_status`;
CREATE TABLE IF NOT EXISTS `article_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `article_status`
--

INSERT INTO `article_status` (`id`, `name`) VALUES
(1, 'undefined'),
(2, 'new'),
(3, 'editing'),
(4, 'confirmed'),
(5, 'deleted');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` date NOT NULL,
  `date_last_modification` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `date_creation`, `date_last_modification`) VALUES
(1, 'News', '2015-08-04', '2015-08-04 08:02:23'),
(2, 'Tech', '2015-08-04', '2015-08-04 08:02:27'),
(3, 'Cars', '2015-08-04', '2015-08-04 08:02:30'),
(4, 'Sport', '2015-08-04', '2015-08-04 08:03:50');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_writer_id` int(11) NOT NULL,
  `comment_content` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `article_id` int(11) NOT NULL,
  `comment_parent_id` int(11) DEFAULT NULL,
  `date_creation` date NOT NULL,
  `date_last_modification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `comment_writer_id` (`comment_writer_id`),
  KEY `comment_parent_id` (`comment_parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `comment_writer_id`, `comment_content`, `article_id`, `comment_parent_id`, `date_creation`, `date_last_modification`) VALUES
(2, 2, 'TEST AMIR', 2, NULL, '0000-00-00', '2015-08-14 07:59:42'),
(3, 2, 'AVIRAN'' postcom', 2, NULL, '0000-00-00', '2015-08-14 08:00:22'),
(4, 1, 'Viv', 2, NULL, '0000-00-00', '2015-08-14 08:45:50'),
(5, 1, 'טסט\n', 2, NULL, '0000-00-00', '2015-08-14 14:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userNameFirst` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `userNameLast` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `userPassword` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `userEmail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `userStatus` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userStatus` (`userStatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `userNameFirst`, `userNameLast`, `userPassword`, `userEmail`, `userStatus`) VALUES
(1, '', 'Anonymous', '01101986', 'yoskovitz-a@info.cts.org.il', 3),
(2, 'Arkadi', 'Yoskovitz', '01101986', 'arkadi.yoskovitz@gmail.com', 3),
(3, 'amir', 'brot', 'Nikond800', 'amirbrot@ymail.com', 3),
(4, 'Amir', 'Brot', 'nikond800', 'amirbrot@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

DROP TABLE IF EXISTS `user_status`;
CREATE TABLE IF NOT EXISTS `user_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`id`, `name`) VALUES
(1, 'undefined'),
(2, 'registered'),
(3, 'confirmed'),
(4, 'deleted');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`article_status`) REFERENCES `article_status` (`id`),
  ADD CONSTRAINT `article_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `article_ibfk_4` FOREIGN KEY (`writer_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`comment_writer_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userStatus`) REFERENCES `user_status` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
