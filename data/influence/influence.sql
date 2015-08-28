--
-- Table structure for table `in_locations`
--

CREATE TABLE IF NOT EXISTS `in_locations` (
  `id` int(11) NOT NULL,
  `total_week` int(11) NOT NULL DEFAULT '0',
  `total_month` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='locations';

-- --------------------------------------------------------

--
-- Table structure for table `in_snapshots`
--

CREATE TABLE IF NOT EXISTS `in_snapshots` (
  `id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `rating` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
